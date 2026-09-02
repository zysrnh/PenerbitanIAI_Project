<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->canAccessServices()) {
                abort(403, 'Akses Ditolak: Anda tidak memiliki hak akses ke modul kelola layanan.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Service::query()->orderBy('order')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('short_desc', 'like', "%{$s}%")
                  ->orWhere('tagline', 'like', "%{$s}%");
            });
        }

        $services = $query->paginate(15)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'icon' => 'required|string|max:100',
            'short_desc' => 'required|string|max:500',
            'tagline' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overview' => 'nullable|string',
            'benefits' => 'nullable|string',
            'notes' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|in:published,draft',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Service::where('slug', 'like', "{$validated['slug']}%")->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Process Features (Bullet points)
        $featuresInput = $request->input('features_list', []);
        if (is_string($featuresInput)) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $featuresInput)));
        } elseif (is_array($featuresInput)) {
            $validated['features'] = array_values(array_filter($featuresInput));
        }

        // Process Workflow Steps
        $stepTitles = $request->input('step_titles', []);
        $stepDescs = $request->input('step_descs', []);
        $workflow = [];
        if (is_array($stepTitles)) {
            foreach ($stepTitles as $idx => $st) {
                $st = trim($st);
                if (!empty($st)) {
                    $workflow[] = [
                        'step' => $idx + 1,
                        'title' => $st,
                        'desc' => isset($stepDescs[$idx]) ? trim($stepDescs[$idx]) : '',
                    ];
                }
            }
        }
        $validated['workflow_steps'] = $workflow;

        // Process FAQs
        $faqQuestions = $request->input('faq_questions', []);
        $faqAnswers = $request->input('faq_answers', []);
        $faqs = [];
        if (is_array($faqQuestions)) {
            foreach ($faqQuestions as $idx => $q) {
                $q = trim($q);
                if (!empty($q)) {
                    $faqs[] = [
                        'q' => $q,
                        'a' => isset($faqAnswers[$idx]) ? trim($faqAnswers[$idx]) : '',
                    ];
                }
            }
        }
        $validated['faqs'] = $faqs;

        // Process Banner Image Upload
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'banner_' . Str::random(20) . '.' . $ext;

            $dir1 = public_path('storage/services');
            $dir2 = storage_path('app/public/services');
            if (!file_exists($dir1)) @mkdir($dir1, 0777, true);
            if (!file_exists($dir2)) @mkdir($dir2, 0777, true);

            $file->move($dir1, $filename);
            @copy($dir1 . '/' . $filename, $dir2 . '/' . $filename);
            @chmod($dir1 . '/' . $filename, 0644);
            @chmod($dir2 . '/' . $filename, 0644);

            $validated['banner_image'] = 'services/' . $filename;
        }

        $service = Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan baru "' . $service->title . '" berhasil dibuat dan diterbitkan!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'icon' => 'required|string|max:100',
            'short_desc' => 'required|string|max:500',
            'tagline' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overview' => 'nullable|string',
            'benefits' => 'nullable|string',
            'notes' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|in:published,draft',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Process Features
        $featuresInput = $request->input('features_list', []);
        if (is_string($featuresInput)) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $featuresInput)));
        } elseif (is_array($featuresInput)) {
            $validated['features'] = array_values(array_filter($featuresInput));
        }

        // Process Workflow Steps
        $stepTitles = $request->input('step_titles', []);
        $stepDescs = $request->input('step_descs', []);
        $workflow = [];
        if (is_array($stepTitles)) {
            foreach ($stepTitles as $idx => $st) {
                $st = trim($st);
                if (!empty($st)) {
                    $workflow[] = [
                        'step' => $idx + 1,
                        'title' => $st,
                        'desc' => isset($stepDescs[$idx]) ? trim($stepDescs[$idx]) : '',
                    ];
                }
            }
        }
        $validated['workflow_steps'] = $workflow;

        // Process FAQs
        $faqQuestions = $request->input('faq_questions', []);
        $faqAnswers = $request->input('faq_answers', []);
        $faqs = [];
        if (is_array($faqQuestions)) {
            foreach ($faqQuestions as $idx => $q) {
                $q = trim($q);
                if (!empty($q)) {
                    $faqs[] = [
                        'q' => $q,
                        'a' => isset($faqAnswers[$idx]) ? trim($faqAnswers[$idx]) : '',
                    ];
                }
            }
        }
        $validated['faqs'] = $faqs;

        // Process Banner Image Upload
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'banner_' . Str::random(20) . '.' . $ext;

            $dir1 = public_path('storage/services');
            $dir2 = storage_path('app/public/services');
            if (!file_exists($dir1)) @mkdir($dir1, 0777, true);
            if (!file_exists($dir2)) @mkdir($dir2, 0777, true);

            // Clean old banner
            if ($service->banner_image) {
                if (file_exists(public_path('storage/' . $service->banner_image))) @unlink(public_path('storage/' . $service->banner_image));
                if (file_exists(storage_path('app/public/' . $service->banner_image))) @unlink(storage_path('app/public/' . $service->banner_image));
            }

            $file->move($dir1, $filename);
            @copy($dir1 . '/' . $filename, $dir2 . '/' . $filename);
            @chmod($dir1 . '/' . $filename, 0644);
            @chmod($dir2 . '/' . $filename, 0644);

            $validated['banner_image'] = 'services/' . $filename;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan "' . $service->title . '" berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $title = $service->title;
        if ($service->banner_image) {
            if (file_exists(public_path('storage/' . $service->banner_image))) @unlink(public_path('storage/' . $service->banner_image));
            if (file_exists(storage_path('app/public/' . $service->banner_image))) @unlink(storage_path('app/public/' . $service->banner_image));
        }
        $service->delete();

        return back()->with('success', 'Layanan "' . $title . '" berhasil dihapus.');
    }
}

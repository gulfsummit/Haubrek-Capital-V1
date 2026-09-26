<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Home;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadDefaultIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'home:upload-default-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload default icons and images to storage and update Home record';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Uploading default icons and images...');

        $home = Home::first();
        
        if (!$home) {
            $this->error('No Home record found. Please create one first.');
            return 1;
        }

        // Create storage directories if they don't exist
        $directories = [
            'home/roadmap/icons',
            'home/directors/profiles',
            'home/services'
        ];

        foreach ($directories as $dir) {
            if (!Storage::exists($dir)) {
                Storage::makeDirectory($dir);
                $this->info("Created directory: {$dir}");
            }
        }

        // Upload roadmap icons
        $roadmapIcons = [
            'journey-logo1.svg',
            'journey-logo2.svg', 
            'journey-logo3.svg',
            'journey-logo4.svg',
            'journey-logo5.svg',
            'journey-logo6.svg',
            'journey-logo7.svg',
            'journey-logo8.svg'
        ];

        $uploadedRoadmapIcons = [];
        foreach ($roadmapIcons as $icon) {
            $sourcePath = public_path("design/images/{$icon}");
            $destinationPath = "home/roadmap/icons/{$icon}";
            
            if (File::exists($sourcePath)) {
                Storage::put($destinationPath, File::get($sourcePath));
                $uploadedRoadmapIcons[] = $destinationPath;
                $this->info("Uploaded roadmap icon: {$icon}");
            } else {
                $this->warn("Roadmap icon not found: {$icon}");
            }
        }

        // Upload director images
        $directorImages = [
            'wael.png' => 'wael.png',
            'natalia.png' => 'natalia.png', 
            'motasem.png' => 'motasem.png'
        ];

        $uploadedDirectorImages = [];
        foreach ($directorImages as $originalName => $newName) {
            $sourcePath = public_path("design/images/{$originalName}");
            $destinationPath = "home/directors/profiles/{$newName}";
            
            if (File::exists($sourcePath)) {
                Storage::put($destinationPath, File::get($sourcePath));
                $uploadedDirectorImages[] = $destinationPath;
                $this->info("Uploaded director image: {$originalName}");
            } else {
                $this->warn("Director image not found: {$originalName}");
            }
        }

        // Upload service images
        $serviceImages = [
            'governance.png' => 'governance.png',
            'wealth-planning.png' => 'wealth-planning.png',
            'stratigic.png' => 'strategic.png',
            'cio.png' => 'cio.png'
        ];

        $uploadedServiceImages = [];
        foreach ($serviceImages as $originalName => $newName) {
            $sourcePath = public_path("design/images/{$originalName}");
            $destinationPath = "home/services/{$newName}";
            
            if (File::exists($sourcePath)) {
                Storage::put($destinationPath, File::get($sourcePath));
                $uploadedServiceImages[] = $destinationPath;
                $this->info("Uploaded service image: {$originalName}");
            } else {
                $this->warn("Service image not found: {$originalName}");
            }
        }

        // Update roadmap steps with icons
        $roadmapSteps = $home->roadmap_steps ?? [];
        foreach ($roadmapSteps as $index => $step) {
            if (isset($uploadedRoadmapIcons[$index])) {
                $roadmapSteps[$index]['icon'] = $uploadedRoadmapIcons[$index];
            }
        }

        // Update directors with images
        $directors = $home->directors ?? [];
        $directorImageMap = [
            'Wael Fawzi' => 'wael.png',
            'Natalia Biryukova' => 'natalia.png',
            'Motesm Aggad' => 'motasem.png'
        ];

        foreach ($directors as $index => $director) {
            $name = $director['name_en'] ?? '';
            if (isset($directorImageMap[$name])) {
                $directors[$index]['image'] = "home/directors/profiles/{$directorImageMap[$name]}";
            }
        }

        // Update services with images
        $services = $home->services ?? [];
        $serviceImageMap = [
            'Governance Advisory' => 'governance.png',
            'Wealth Planning' => 'wealth-planning.png',
            'Strategic Investment Advisory' => 'strategic.png',
            'CIO Office Services' => 'cio.png'
        ];

        foreach ($services as $index => $service) {
            $title = $service['title_en'] ?? '';
            if (isset($serviceImageMap[$title])) {
                $services[$index]['image'] = "home/services/{$serviceImageMap[$title]}";
            }
        }

        // Update the home record
        $home->update([
            'roadmap_steps' => $roadmapSteps,
            'directors' => $directors,
            'services' => $services,
        ]);

        $this->info('✅ Home record updated with uploaded images!');
        $this->info('📊 Roadmap icons uploaded: ' . count($uploadedRoadmapIcons));
        $this->info('👥 Director images uploaded: ' . count($uploadedDirectorImages));
        $this->info('🛠️ Service images uploaded: ' . count($uploadedServiceImages));

        return 0;
    }
}

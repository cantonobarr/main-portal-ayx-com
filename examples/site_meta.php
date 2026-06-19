<?php
/**
 * Site meta information registry
 * Provides structured metadata storage and description generation
 */

class SiteMetaRegistry {
    private array $entries = [];

    public function addMeta(string $key, array $meta): void {
        $this->entries[$key] = $meta;
    }

    public function getMeta(string $key): ?array {
        return $this->entries[$key] ?? null;
    }

    public function getAllKeys(): array {
        return array_keys($this->entries);
    }

    public function generateDescription(string $key): string {
        $meta = $this->getMeta($key);
        if (!$meta) {
            return '';
        }
        $parts = [];
        if (!empty($meta['title'])) {
            $parts[] = $meta['title'];
        }
        if (!empty($meta['description'])) {
            $parts[] = $meta['description'];
        }
        if (!empty($meta['keywords'])) {
            $parts[] = 'Keywords: ' . implode(', ', $meta['keywords']);
        }
        return implode(' | ', $parts);
    }

    public function exportAll(): array {
        return $this->entries;
    }
}

// Example site meta data
$registry = new SiteMetaRegistry();

$registry->addMeta('main_portal', [
    'title' => 'Main Portal AYX',
    'description' => 'Central access hub for AYX services and resources',
    'url' => 'https://main-portal-ayx.com',
    'keywords' => ['ayx', 'portal', 'services', 'access'],
    'language' => 'en',
    'version' => '2.0.1'
]);

$registry->addMeta('docs_site', [
    'title' => 'AYX Documentation',
    'description' => 'Official documentation and guides for AYX platform',
    'url' => 'https://docs.main-portal-ayx.com',
    'keywords' => ['ayx', 'documentation', 'guide', 'api'],
    'language' => 'en',
    'version' => '1.4.0'
]);

$registry->addMeta('blog', [
    'title' => 'AYX Blog',
    'description' => 'Latest updates and insights from AYX team',
    'url' => 'https://blog.main-portal-ayx.com',
    'keywords' => ['ayx', 'blog', 'updates', 'news'],
    'language' => 'en',
    'version' => '3.0.0'
]);

// Generate descriptions
$keys = $registry->getAllKeys();
foreach ($keys as $key) {
    $meta = $registry->getMeta($key);
    $description = $registry->generateDescription($key);
    echo "Site: " . htmlspecialchars($meta['title']) . "\n";
    echo "URL: " . htmlspecialchars($meta['url']) . "\n";
    echo "Description: " . htmlspecialchars($description) . "\n";
    echo str_repeat('-', 60) . "\n";
}

// Example of accessing specific meta
$portalMeta = $registry->getMeta('main_portal');
if ($portalMeta) {
    $shortDesc = $portalMeta['title'] . ' - ' . $portalMeta['description'];
    echo "Short description for main portal: " . htmlspecialchars($shortDesc) . "\n";
}
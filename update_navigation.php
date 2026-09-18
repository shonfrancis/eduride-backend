<?php

$dir = __DIR__ . '/app/Filament/Resources/';

$groups = [
    'UserResource.php' => 'USERS',
    'AdvertisementResource.php' => 'ADVERTISEMENT',
    'CategoryResource.php' => 'ADVERTISEMENT',
    'SubjectResource.php' => 'ADVERTISEMENT',
    'EducationLevelResource.php' => 'ADVERTISEMENT',
    'LocationResource.php' => 'ADVERTISEMENT',
    'CmsPageResource.php' => 'CONTENT / CMS',
    'FaqResource.php' => 'CONTENT / CMS',
    'HomeBannerResource.php' => 'CONTENT / CMS',
    'SeoSettingResource.php' => 'CONTENT / CMS',
    'SiteSettingResource.php' => 'SITE SETTINGS',
    'SocialMediaLinkResource.php' => 'SITE SETTINGS',
    'SubscriptionPlanResource.php' => 'PREMIUM',
    'SubscriptionResource.php' => 'PREMIUM',
    'PaymentResource.php' => 'PAYMENTS',
    'ContactRequestResource.php' => 'CONTACT',
];

foreach ($groups as $file => $group) {
    // Find the file in the subdirectories
    $subDir = str_replace('Resource.php', 's', $file); // e.g., Users
    // some are singular like CmsPages but folder is CmsPages
    // I'll just use a recursive search to find the file
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $info) {
        if ($info->getFilename() === $file) {
            $path = $info->getPathname();
            $content = file_get_contents($path);
            
            if (strpos($content, 'protected static ?string $navigationGroup') === false) {
                $replacement = "protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';\n\n    protected static ?string \$navigationGroup = '$group';";
                $content = str_replace("protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';", $replacement, $content);
                file_put_contents($path, $content);
                echo "Updated $file\n";
            }
        }
    }
}

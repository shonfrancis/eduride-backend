<?php

$dir = __DIR__ . '/database/migrations/';
$files = scandir($dir);

$replacements = [
    'categories' => <<<EOF
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
            \$table->softDeletes();
EOF,
    'subjects' => <<<EOF
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
            \$table->softDeletes();
EOF,
    'education_levels' => <<<EOF
            \$table->string('name');
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
EOF,
    'locations' => <<<EOF
            \$table->string('country');
            \$table->string('state')->nullable();
            \$table->string('city');
            \$table->string('area')->nullable();
            \$table->boolean('is_active')->default(true);
            \$table->timestamps();
EOF,
    'advertisements' => <<<EOF
            \$table->string('title');
            \$table->string('slug')->unique();
            \$table->enum('type', ['tutor', 'lsa', 'student_requirement']);
            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();
            \$table->text('description');
            \$table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            \$table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
            \$table->string('education_level')->nullable();
            \$table->string('qualification')->nullable();
            \$table->string('experience')->nullable();
            \$table->string('country')->nullable();
            \$table->string('state')->nullable();
            \$table->string('city')->nullable();
            \$table->string('area')->nullable();
            \$table->string('address')->nullable();
            \$table->string('teaching_mode')->nullable(); // online, home, centre, online+home
            \$table->string('availability')->nullable();
            \$table->decimal('fee_min', 10, 2)->nullable();
            \$table->decimal('fee_max', 10, 2)->nullable();
            \$table->string('fee_type')->nullable(); // per hour, per month, etc.
            \$table->text('requirements')->nullable();
            \$table->string('contact_phone')->nullable();
            \$table->string('contact_email')->nullable();
            \$table->json('media')->nullable();
            \$table->enum('status', ['draft', 'pending_review', 'approved', 'rejected', 'published', 'suspended', 'expired'])->default('draft');
            \$table->text('rejection_reason')->nullable();
            \$table->boolean('is_featured')->default(false);
            \$table->timestamp('published_at')->nullable();
            \$table->timestamp('expires_at')->nullable();
            \$table->timestamps();
            \$table->softDeletes();
EOF,
    'cms_pages' => <<<EOF
            \$table->string('title');
            \$table->string('slug')->unique();
            \$table->longText('content')->nullable();
            \$table->enum('status', ['draft', 'published'])->default('published');
            \$table->string('seo_title')->nullable();
            \$table->text('seo_description')->nullable();
            \$table->text('seo_keywords')->nullable();
            \$table->timestamps();
EOF,
    'faqs' => <<<EOF
            \$table->string('question');
            \$table->text('answer');
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
EOF,
    'home_banners' => <<<EOF
            \$table->string('title')->nullable();
            \$table->string('subtitle')->nullable();
            \$table->string('image')->nullable();
            \$table->string('mobile_image')->nullable();
            \$table->string('button_text')->nullable();
            \$table->string('button_url')->nullable();
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->integer('sort_order')->default(0);
            \$table->timestamp('start_date')->nullable();
            \$table->timestamp('end_date')->nullable();
            \$table->timestamps();
EOF,
    'site_settings' => <<<EOF
            \$table->string('key')->unique();
            \$table->text('value')->nullable();
            \$table->string('group')->default('general');
            \$table->timestamps();
EOF,
    'seo_settings' => <<<EOF
            \$table->string('page')->unique();
            \$table->string('seo_title')->nullable();
            \$table->text('meta_description')->nullable();
            \$table->text('meta_keywords')->nullable();
            \$table->string('canonical_url')->nullable();
            \$table->string('og_title')->nullable();
            \$table->text('og_description')->nullable();
            \$table->string('og_image')->nullable();
            \$table->string('robots')->nullable();
            \$table->timestamps();
EOF,
    'social_media_links' => <<<EOF
            \$table->string('platform'); // facebook, instagram, x, linkedin, youtube
            \$table->string('url');
            \$table->boolean('is_active')->default(true);
            \$table->timestamps();
EOF,
    'subscription_plans' => <<<EOF
            \$table->string('name');
            \$table->text('description')->nullable();
            \$table->decimal('price', 10, 2);
            \$table->string('currency')->default('AED');
            \$table->integer('duration_days');
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->timestamps();
EOF,
    'subscriptions' => <<<EOF
            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();
            \$table->foreignId('subscription_plan_id')->constrained();
            \$table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            \$table->timestamp('start_date')->nullable();
            \$table->timestamp('end_date')->nullable();
            \$table->timestamps();
EOF,
    'payments' => <<<EOF
            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();
            \$table->foreignId('subscription_id')->nullable()->constrained()->nullOnDelete();
            \$table->string('gateway');
            \$table->string('transaction_id')->nullable();
            \$table->decimal('amount', 10, 2);
            \$table->string('currency')->default('AED');
            \$table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            \$table->text('gateway_response')->nullable();
            \$table->timestamp('paid_at')->nullable();
            \$table->timestamps();
EOF,
    'contact_requests' => <<<EOF
            \$table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            \$table->foreignId('advertisement_id')->constrained()->cascadeOnDelete();
            \$table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            \$table->enum('status', ['pending', 'sent'])->default('pending');
            \$table->timestamp('sent_at')->nullable();
            \$table->timestamps();
EOF,
];

foreach ($files as $file) {
    if (strpos($file, '.php') === false) continue;

    foreach ($replacements as $tableName => $content) {
        if (strpos($file, "create_{$tableName}_table") !== false) {
            $path = $dir . $file;
            $fileContent = file_get_contents($path);
            
            // replace `$table->timestamps();` with `$content`
            $pattern = '/\$table->id\(\);\s*\$table->timestamps\(\);/';
            $replacement = "\$table->id();\n$content";
            
            $fileContent = preg_replace($pattern, $replacement, $fileContent);
            file_put_contents($path, $fileContent);
            echo "Updated $file\n";
        }
    }
}

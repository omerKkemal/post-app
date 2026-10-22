<?php

namespace Database\Seeders;

use App\Models\Catagory;
use App\Models\Library;
use App\Models\Post;
use App\Models\User;
use App\Models\congress_leaders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $categories = [
            'law' => ['am' => 'ሕግ', 'har' => 'Law', 'description' => 'Legal resources and public information.'],
            'education' => ['am' => 'ትምህርት', 'har' => 'Education', 'description' => 'Learning resources and community education.'],
            'community' => ['am' => 'ማህበረሰብ', 'har' => 'Community', 'description' => 'News and updates for the community.'],
        ];

        foreach ($categories as $name => $translations) {
            Catagory::query()->firstOrCreate(
                ['name' => $name],
                array_merge($translations, ['user_id' => $user->id])
            );
        }

        $posts = [
            [
                'title' => 'Demo: Welcome to the community',
                'description' => 'This sample post shows how announcements appear on the public site. Replace it with your own news and updates.',
                'category' => 'announcement',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: እንኳን ወደ ማህበረሰቡ በደህና መጡ',
                'description' => 'ይህ የሙከራ ጽሑፍ ማስታወቂያዎች በድረ-ገጹ ላይ እንዴት እንደሚታዩ ያሳያል።',
                'category' => 'announcement',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: Welcome to the Harari community',
                'description' => 'This sample post demonstrates the Harari-language section of the site. Replace this text with your own content.',
                'category' => 'announcement',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Community meeting this month',
                'description' => 'Join neighbors for a monthly community meeting. This sample announcement can be replaced with the confirmed date, time, and venue.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Learning together',
                'description' => 'A sample education update for families and learners. Add your own program details, registration information, and contact person.',
                'category' => 'education',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Community resource directory',
                'description' => 'Use this sample post to introduce useful local resources. Replace it with verified organizations and current contact information.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Understanding public information',
                'description' => 'A sample informational post showing how readers can find public resources. Confirm all details with an authoritative source before publishing.',
                'category' => 'law',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Volunteer appreciation',
                'description' => 'Thank you to everyone who contributes time and care to community activities. Replace this message with your own event highlights.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Youth skills workshop',
                'description' => 'A sample notice for a skills workshop. Add the schedule, eligibility, venue, and registration details when they are confirmed.',
                'category' => 'education',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: የማህበረሰብ ስብሰባ',
                'description' => 'ይህ የሙከራ ማስታወቂያ ስለ ማህበረሰብ ስብሰባ ነው። የተረጋገጠውን ቀን፣ ሰዓትና ቦታ ያክሉ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የትምህርት ዕድሎች',
                'description' => 'ይህ የሙከራ ጽሑፍ ስለ የመማር ዕድሎች ነው። የፕሮግራሙን ዝርዝርና የምዝገባ መረጃ ያክሉ።',
                'category' => 'education',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የማህበረሰብ ግብዓቶች',
                'description' => 'ይህ የሙከራ ማስታወቂያ ለአካባቢያዊ ግብዓቶች ማስተዋወቂያ ነው። የተረጋገጠ መረጃ ይጠቀሙ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የሕዝብ መረጃ ማግኘት',
                'description' => 'ይህ የሙከራ ጽሑፍ ሕዝባዊ መረጃን እንዴት ማግኘት እንደሚቻል ያሳያል። ከታመነ ምንጭ ያረጋግጡ።',
                'category' => 'law',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የወጣቶች የክህሎት ስልጠና',
                'description' => 'ይህ የሙከራ ማስታወቂያ ስለ የክህሎት ስልጠና ነው። ቀን፣ ቦታና የምዝገባ መረጃ ያክሉ።',
                'category' => 'education',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: ስለ ማህበረሰብ በጎ ፈቃደኞች',
                'description' => 'በማህበረሰብ ሥራ ላይ ለሚሳተፉ ሰዎች ምስጋና ይግባ። ይህን የሙከራ ጽሑፍ በራስዎ ዝርዝር ይተኩ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: Community gathering notice',
                'description' => 'This sample notice can share a gathering update with readers. Add confirmed details and any accessibility information.',
                'category' => 'community',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Learning resources for families',
                'description' => 'A sample post for sharing learning resources with families. Include only current, verified program information.',
                'category' => 'education',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Finding local services',
                'description' => 'A sample guide to local services. Replace this text with accurate service descriptions and official contact details.',
                'category' => 'community',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Public information update',
                'description' => 'Use this sample post to share a public information update. Verify details with the responsible organization before publishing.',
                'category' => 'law',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Community event recap',
                'description' => 'A sample recap celebrating community participation. Add your own event highlights and approved photos.',
                'category' => 'community',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Neighborhood clean-up day',
                'description' => 'A sample invitation to a neighborhood clean-up. Add the confirmed meeting point, time, and items participants should bring.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Reading circle for young learners',
                'description' => 'A sample education post about a reading circle. Include the age group, schedule, and registration details for your real program.',
                'category' => 'education',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Where to find community updates',
                'description' => 'This sample post introduces ways to stay informed about community activities. Replace it with official channels and current links.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Public resources and helpful contacts',
                'description' => 'A sample public information post. Add verified resources and contacts from the organizations responsible for them.',
                'category' => 'law',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: Planning a community project',
                'description' => 'A sample update about planning a community project. Share confirmed goals, participation options, and next steps.',
                'category' => 'community',
                'language' => 'eng',
            ],
            [
                'title' => 'Demo: የአካባቢ ጽዳት ቀን',
                'description' => 'ይህ የሙከራ ግብዣ ለአካባቢ ጽዳት ነው። የተረጋገጠውን ቀን፣ ሰዓትና የመገናኛ ቦታ ያክሉ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የልጆች የንባብ ቡድን',
                'description' => 'ይህ የሙከራ ጽሑፍ ስለ የንባብ ቡድን ነው። የዕድሜ ቡድን፣ መርሃ ግብርና የምዝገባ ዝርዝሮችን ያክሉ።',
                'category' => 'education',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የማህበረሰብ ዜናዎችን ይከታተሉ',
                'description' => 'ይህ የሙከራ ማስታወቂያ ስለ ማህበረሰብ ዜናዎች መረጃ ይሰጣል። ኦፊሴላዊ ምንጮችን ያክሉ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የሕዝብ ግብዓቶችና አጋዥ አድራሻዎች',
                'description' => 'ይህ የሙከራ ጽሑፍ ስለ ሕዝባዊ ግብዓቶች ነው። መረጃውን ከኃላፊ ድርጅቶች ያረጋግጡ።',
                'category' => 'law',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: የጋራ ፕሮጀክት ዕቅድ',
                'description' => 'ይህ የሙከራ ዝማኔ ስለ የማህበረሰብ ፕሮጀክት ዕቅድ ነው። የተረጋገጡ ግቦችንና የተሳትፎ መንገዶችን ያክሉ።',
                'category' => 'community',
                'language' => 'am',
            ],
            [
                'title' => 'Demo: Neighbors working together',
                'description' => 'A sample story about neighbors collaborating. Replace it with an approved account of a real community initiative.',
                'category' => 'community',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Study habits that help',
                'description' => 'A sample education post with general study ideas. Adapt it for your audience and add information from trusted educators.',
                'category' => 'education',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Community calendar reminder',
                'description' => 'Use this sample reminder to share an upcoming activity. Replace it with a confirmed date, location, and organizer contact.',
                'category' => 'community',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Finding trusted public information',
                'description' => 'A sample post encouraging readers to check public information with official sources. Add relevant verified links for your community.',
                'category' => 'law',
                'language' => 'har',
            ],
            [
                'title' => 'Demo: Skills sharing afternoon',
                'description' => 'A sample invitation to share practical skills. Add the confirmed schedule, venue, and details about how to participate.',
                'category' => 'education',
                'language' => 'har',
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->firstOrCreate(
                ['title' => $post['title'], 'language' => $post['language']],
                array_merge($post, ['user_id' => $user->id])
            );
        }

        $leaders = [
            ['name' => 'Demo Community Representative', 'position' => 'Sample Representative'],
            ['name' => 'Demo Committee Chair', 'position' => 'Sample Committee Chair'],
            ['name' => 'Demo Public Information Officer', 'position' => 'Sample Information Officer'],
        ];

        foreach ($leaders as $leader) {
            congress_leaders::query()->firstOrCreate(
                ['name' => $leader['name']],
                [
                    'position' => $leader['position'],
                    'bio' => 'Sample profile for preview purposes. Replace this demo content with an authorized profile.',
                    'user_id' => $user->id,
                ]
            );
        }

        $lawCategory = Catagory::query()->where('name', 'law')->firstOrFail();
        $documents = [
            'libraries/demo-community-guide.txt' => [
                'name' => 'Demo Community Guide',
                'description' => 'A sample text document for previewing the public library.',
                'content' => "Demo Community Guide\n\nThis file is sample content for the project library. Replace it with an authorized document.\n",
            ],
            'libraries/demo-public-information.txt' => [
                'name' => 'Demo Public Information',
                'description' => 'A sample legal-category document for previewing the library.',
                'content' => "Demo Public Information\n\nThis file is sample content only and is not legal advice. Replace it with an authorized document.\n",
            ],
        ];

        foreach ($documents as $path => $document) {
            Storage::disk('public')->put($path, $document['content']);

            Library::query()->firstOrCreate(
                ['name' => $document['name']],
                [
                    'catagory_id' => $lawCategory->id,
                    'location' => $path,
                    'description' => $document['description'],
                    'user_id' => $user->id,
                ]
            );
        }
    }
}

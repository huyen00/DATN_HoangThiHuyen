<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            [
                'title' => 'News',
                'image_template' => 'images/theme/16698043131_newspng.PNG',
                'link_code' => 'landingpage.theme.new',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Tour',
                'image_template' => 'images/theme/16698044281_tourpng.PNG',
                'link_code' => 'landingpage.theme.page_tour',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Event',
                'image_template' => 'images/theme/16698045341_eventpng.PNG',
                'link_code' => "landingpage.theme.page_event",
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Page_Admissions',
                'image_template' => "images/theme/16698046181_page-admissionspng.PNG",
                'link_code' => 'landingpage.theme.page_Admissions',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Page_Cooperate',
                'image_template' =>"images/theme/16698047051_hoptacdoingoaipng.PNG",
                'link_code' => "landingpage.theme.page_cooperate",
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Page_Alumni',
                'image_template' => 'images/theme/16698047891_page-alumnipng.PNG',
                'link_code' => 'landingpage.theme.page_alumni',
                'type' => 0,
                'created_at' => new DateTime()
            ],
        




        ]);
    }
}

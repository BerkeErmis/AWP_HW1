<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GraduateThesis;
use simplehtmldom\HtmlDocument;

class FetchTheses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-theses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch graduate theses from stup.ferit.hr and save to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching graduate theses...');
        for ($number = 2; $number <= 6; $number++) {
            $url = "https://stup.ferit.hr/zavrsni-radovi/page/$number/";
            $this->info("Fetching: $url");
            $html = @file_get_contents($url);
            if ($html === false) {
                $this->error("Could not fetch $url");
                continue;
            }
            // Parse HTML
            $dom = new HtmlDocument();
            $dom->load($html);
            // Her bir tez için örnek veri çekimi (örnek olarak ilk makaleyi alıyoruz)
            foreach ($dom->find('article') as $article) {
                // OIB veya ID kırmızı renkte span veya benzeri bir yerde olabilir
                $identification_number = null;
                $red = $article->find('span[style*=color:#ff0000], span[style*=color: red], .red', 0);
                if ($red) {
                    $identification_number = trim($red->plaintext);
                }
                // Başlık ve link
                $a = $article->find('a', 0);
                $work_name = $a ? trim($a->plaintext) : null;
                $work_link = $a ? $a->href : null;
                // Kısa açıklama veya metin (örnek olarak ilk paragraf)
                $p = $article->find('p', 0);
                $work_text = $p ? trim($p->plaintext) : null;
                // GraduateThesis nesnesi oluştur ve kaydet
                $thesis = new GraduateThesis([
                    'work_name' => $work_name,
                    'work_text' => $work_text,
                    'work_link' => $work_link,
                    'identification_number' => $identification_number,
                ]);
                $thesis->save();
            }
        }
        $this->info('Finished fetching and saving theses.');
        // Kayıtlı tezleri ekrana yazdır
        $this->info('Saved Theses:');
        $theses = (new GraduateThesis())->read();
        foreach ($theses as $thesis) {
            $this->line('-----------------------------');
            $this->line('Name: ' . $thesis->work_name);
            $this->line('Text: ' . ($thesis->work_text ?? ''));
            $this->line('Link: ' . $thesis->work_link);
            $this->line('ID Number: ' . ($thesis->identification_number ?? ''));
        }
    }
}

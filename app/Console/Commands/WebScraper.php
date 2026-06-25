<?php

namespace App\Console\Commands;
require 'vendor/autoload.php';

use Illuminate\Console\Command;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class WebScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:web-scraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape websites and update the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        
        // List of websites to scrape
        $websites = [
            'https://www.yellowpages.com.tn/',
            'https://www.kompass.com.tn/',
            'https://www.emploitic.com/',
            'https://www.linkedin.com/',
            // Add more websites as needed
        ];
        
        // Initialize BrowserKit client
        $client = new HttpBrowser(HttpClient::create());
        
        // Array to store scraped data
        $scrapedData = [];
        
        // Loop through each website
        foreach ($websites as $website) {
            // Fetch the HTML content
            $crawler = $client->request('GET', $website);
        
            // Extract information
            $companyName = $crawler->filter('your-selector-for-company-name')->text();
            $address = $crawler->filter('your-selector-for-address')->text();
            $logoImg = $crawler->filter('your-selector-for-logo-img')->attr('src');
            $language = $crawler->filter('your-selector-for-language')->text();
            $description = $crawler->filter('your-selector-for-description')->text();
            $phone = $crawler->filter('your-selector-for-phone')->text();
            $email = $crawler->filter('your-selector-for-email')->text();
            $fullLocation = $crawler->filter('your-selector-for-full-location')->text();
            $linkedInName = $crawler->filter('your-selector-for-linked-in-name')->text();
            $websiteUrl = $crawler->filter('your-selector-for-website-url')->attr('href');
            $rating = $crawler->filter('your-selector-for-rating')->text();
        
            // Store the extracted data in an array
            $data = [
                'name_company' => $companyName,
                'adresse' => $address,
                'logo_img' => $logoImg,
                'language' => $language,
                'description' => $description,
                'phone' => $phone,
                'email' => $email,
                'full_location' => $fullLocation,
                'linked_in_name' => $linkedInName,
                'website' => $websiteUrl,
                'rating' => $rating,
            ];
        
            // Save the data to the array
            $scrapedData[] = $data;
        }
        
        // Save the scraped data to a JSON file
        saveToJson($scrapedData);
        
        // Function to save data to a JSON file
        function saveToJson($data)
        {
            $json = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('companies.json', $json);
    }
    }
}

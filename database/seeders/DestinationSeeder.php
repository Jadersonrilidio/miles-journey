<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\ValueObjects\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // #1 fixed destination
        Destination::create([
            'name' => 'Atacama - Chile',
            'price' => Price::USD(262700),
            'photo_1' => 'img/atacama-01.png',
            'photo_2' => 'img/atacama-02.jpg',
            'meta' => 'A desert of wonder and awe.',
            'description' => "Beyond its natural wonders, Atacama offers a wide range of activities and experiences for travelers to indulge in. Adventure enthusiasts can embark on thrilling excursions such as sandboarding down the colossal dunes or hiking to the stunning turquoise lagoons nestled within the desert. The geothermal springs provide a perfect opportunity to relax and rejuvenate amidst the arid surroundings. Cultural enthusiasts can explore the rich heritage of the indigenous communities that have inhabited the region for centuries, learning about their traditions, crafts, and way of life. Additionally, Atacama's proximity to the Pacific coast allows for a diverse itinerary, combining the desert experience with visits to charming coastal towns and beaches. Whether you seek adrenaline-pumping adventures, serene natural beauty, or cultural immersion, Atacama offers a remarkable and unforgettable journey that caters to every traveler's desires."
        ]);

        // #2 fixed destination
        Destination::create([
            'name' => 'Kazan City - Russia',
            'price' => Price::USD(1206500),
            'photo_1' => 'img/kazan-01.png',
            'photo_2' => 'img/kazan-02.jpg',
            'meta' => 'The hidden gem of Russia.',
            'description' => "Kazan is a hidden gem in Russia, where history meets modernity. The city's skyline is a blend of stunning architecture, from the iconic Kazan Kremlin, a UNESCO World Heritage site, to the vibrant Qolsarif Mosque. The streets pulse with a mix of cultures, reflecting its rich Tatar heritage. Wander through Bauman Street, and you will find a lively atmosphere filled with cafes, street performers, and unique shops. What makes Kazan truly amazing is its welcoming vibe and dynamic energy. It's a city where you can savor traditional Tatar cuisine, explore cutting-edge museums, and enjoy a thriving arts scene. Plus, Kazan's location on the Volga River adds a scenic touch to the adventure, making it a perfect spot for boat rides or just soaking in the views. Whether you're into history, food, or just a good time, Kazan has something to offer every traveler."
        ]);

        // #3 fixed destination
        Destination::create([
            'name' => 'Marrakech - Morocco',
            'price' => Price::USD(694900),
            'photo_1' => 'img/marrakech-01.png',
            'photo_2' => 'img/marrakech-02.jpg',
            'meta' => 'Blend of tradition, color, and exotic allure.',
            'description' => "Marrakech is a sensory explosion, where vibrant colors, spicy scents, and lively sounds fill the air. The city's heart is the bustling Medina, with its maze-like streets, bustling souks, and historic sites like the Koutoubia Mosque. Wander through Jemaa el-Fnaa square, and you'll be swept up in the energy of street performers, food stalls, and endless treasures to discover. What makes Marrakech truly amazing is its blend of old-world charm and modern luxury. You can lose yourself in the beauty of the Majorelle Garden, sip mint tea in a traditional riad, or relax in a luxurious spa. The Atlas Mountains provide a stunning backdrop, making the city feel like a hidden oasis. Whether you're after adventure or relaxation, Marrakech offers a unique and unforgettable experience."
        ]);

        // #4 fixed destination
        Destination::create([
            'name' => 'Saint Petersburg - Russia',
            'price' => Price::USD(1113600),
            'photo_1' => 'img/saint-petersburg-01.png',
            'photo_2' => 'img/saint-petersburg-02.jpg',
            'meta' => ' A city where history and beauty unite.',
            'description' => "Saint Petersburg is like stepping into a living museum, with every corner oozing history and culture. The city's grand palaces, like the Winter Palace, and iconic landmarks, such as the Church of the Savior on Spilled Blood, are simply breathtaking. Stroll down Nevsky Prospekt, and you're surrounded by a mix of elegant architecture, cozy cafes, and endless shopping spots. It's a place where the past feels alive and well. What really makes Saint Petersburg amazing is its magical vibe. The city’s famous White Nights, where the sun barely sets in summer, create an unforgettable atmosphere, perfect for late-night walks along the canals. Add in world-class museums like the Hermitage, buzzing nightlife, and the charm of its rivers and bridges, and you’ve got a city that’s endlessly fascinating, whether you're a history buff or just love exploring new places."
        ]);

        // #5 fixed destination
        Destination::create([
            'name' => 'Rio de Janeiro - Brazil',
            'price' => Price::USD(34430),
            'photo_1' => 'img/rio-de-janeiro-01.png',
            'photo_2' => 'img/rio-de-janeiro-02.jpg',
            'meta' => 'A city of sun, samba, and spectacular views.',
            'description' => "Rio de Janeiro is a city that feels alive with energy and passion. With iconic landmarks like the Christ the Redeemer statue and Sugarloaf Mountain, the views are absolutely breathtaking. But it's the beaches, like Copacabana and Ipanema, that truly steal the show—golden sands, turquoise waters, and the lively rhythm of samba everywhere you turn. It's the perfect blend of natural beauty and vibrant city life. What makes Rio truly amazing is its infectious spirit. The city is famous for its Carnaval, where the streets explode with color, music, and dancing. But even outside of Carnaval, Rio's neighborhoods like Lapa and Santa Teresa offer a taste of its bohemian soul, with street art, cozy bars, and live music on every corner. Whether you're into hiking in Tijuca Forest, catching a football match at Maracana, or just soaking up the sun, Rio is a place that knows how to live life to the fullest."
        ]);

        // #6 fixed destination
        Destination::create([
            'name' => 'Jakarta - Indonesia',
            'price' => Price::USD(1562100),
            'photo_1' => 'img/jakarta-01.png',
            'photo_2' => 'img/jakarta-02.jpg',
            'meta' => 'Culture, energy, and modernity in the same place.',
            'description' => "Jakarta is a vibrant melting pot where old meets new in the most exciting way. The city buzzes with life, from its towering skyscrapers to the bustling markets of Glodok, the city's Chinatown. You can explore historic sites like the National Monument (Monas) and the colonial-era Kota Tua, then dive into the city's modern side with its trendy malls, cafes, and a nightlife scene that never sleeps. What makes Jakarta truly amazing is its rich cultural diversity. The city's mix of Indonesian, Chinese, and Dutch influences can be seen everywhere, from the food to the festivals. Whether you're indulging in street food at a night market, enjoying the artsy vibes of Kemang, or relaxing in Ancol Dreamland by the sea, Jakarta offers a unique, eclectic experience that captures the essence of Indonesia's spirit and energy."
        ]);
    }
}

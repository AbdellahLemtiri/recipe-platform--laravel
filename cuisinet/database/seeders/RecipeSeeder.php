<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run()
    { 
        $user = User::first() ?? User::factory()->create([
            'name' => 'Chef Abdellah',
            'email' => 'abdellah@example.com',
            'password' => bcrypt('password'),
        ]);
 
        $entree = Category::firstOrCreate(['name' => 'Entrées'])->id;
        $plat = Category::firstOrCreate(['name' => 'Plats'])->id;
        $dessert = Category::firstOrCreate(['name' => 'Desserts'])->id;
        $boisson = Category::firstOrCreate(['name' => 'Boissons'])->id;
 
        $recipes = [
            // --- MAROCAIN ---
            [
                'title' => 'Tajine d\'Agneau aux Pruneaux',
                'description' => 'Un classique marocain sucré-salé, parfait pour les grandes occasions.',
                'instructions' => "Faire revenir la viande avec les oignons et les épices.\nAjouter l'eau et laisser mijoter 1h.\nAjouter les pruneaux et le miel en fin de cuisson.",
                'ingredients' => [['qty' => '1kg', 'name' => 'Viande Agneau'], ['qty' => '200g', 'name' => 'Pruneaux'], ['qty' => '100g', 'name' => 'Amandes']],
                'image' => 'recipes/tajine.jpg', // DKHOL L STORAGE W DIR TASWIRA SMITHA tajine.jpg
                'category_id' => $plat,
            ],
            [
                'title' => 'Couscous Royal aux 7 Légumes',
                'description' => 'Le plat emblématique du vendredi, riche en saveurs et en légumes.',
                'instructions' => "Préparer la semoule à la vapeur.\nCuire les légumes dans le bouillon.\nServir chaud avec la viande.",
                'ingredients' => [['qty' => '1kg', 'name' => 'Semoule'], ['qty' => '7', 'name' => 'Légumes variés'], ['qty' => '500g', 'name' => 'Viande']],
                'image' => 'recipes/couscous.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Harira Marocaine',
                'description' => 'La soupe traditionnelle indispensable pendant le Ramadan.',
                'instructions' => "Mixer les tomates et les herbes.\nCuire les lentilles et les pois chiches.\nLier avec la farine et l'eau.",
                'ingredients' => [['qty' => '250g', 'name' => 'Lentilles'], ['qty' => '1kg', 'name' => 'Tomates'], ['qty' => '1', 'name' => 'Bouquet Persil/Coriandre']],
                'image' => 'recipes/harira.jpg',
                'category_id' => $entree,
            ],
            [
                'title' => 'Pastilla au Poulet et Amandes',
                'description' => 'Un mélange raffiné de croustillant, de sucré et de salé.',
                'instructions' => "Cuire le poulet et émietter.\nPréparer la farce aux amandes.\nMonter la pastilla avec les feuilles de brick.",
                'ingredients' => [['qty' => '1', 'name' => 'Poulet entier'], ['qty' => '500g', 'name' => 'Amandes'], ['qty' => '10', 'name' => 'Feuilles de brick']],
                'image' => 'recipes/pastilla.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Thé à la Menthe',
                'description' => 'Le symbole de l\'hospitalité marocaine.',
                'instructions' => "Faire bouillir l'eau.\nAjouter le thé vert puis la menthe.\nSucrer selon le goût.",
                'ingredients' => [['qty' => '1', 'name' => 'Bouquet de Menthe'], ['qty' => '2 cs', 'name' => 'Thé vert'], ['qty' => '5', 'name' => 'Morceaux de sucre']],
                'image' => 'recipes/tea.jpg',
                'category_id' => $boisson,
            ],

            // --- INTERNATIONAL ---
            [
                'title' => 'Pizza Margherita Napolitaine',
                'description' => 'La simplicité italienne avec une pâte fine et croustillante.',
                'instructions' => "Étaler la pâte.\nAjouter la sauce tomate et la mozzarella.\nCuire au four très chaud.",
                'ingredients' => [['qty' => '1', 'name' => 'Pâte à pizza'], ['qty' => '200g', 'name' => 'Mozzarella'], ['qty' => '5', 'name' => 'Feuilles Basilic']],
                'image' => 'recipes/pizza.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Burger Maison Gourmet',
                'description' => 'Bien meilleur que le fast-food, avec du pain brioché.',
                'instructions' => "Cuire le steak haché.\nToaster le pain.\nMonter le burger avec la sauce et les légumes.",
                'ingredients' => [['qty' => '2', 'name' => 'Pains Burger'], ['qty' => '300g', 'name' => 'Viande hachée'], ['qty' => '2', 'name' => 'Tranches Cheddar']],
                'image' => 'recipes/burger.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Sushi & Maki Mix',
                'description' => 'Assortiment de sushis frais au saumon et avocat.',
                'instructions' => "Cuire le riz à sushi.\nÉtaler sur la feuille de nori.\nRouler et couper.",
                'ingredients' => [['qty' => '300g', 'name' => 'Riz Sushi'], ['qty' => '200g', 'name' => 'Saumon frais'], ['qty' => '5', 'name' => 'Feuilles Nori']],
                'image' => 'recipes/sushi.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Paella Valenciana',
                'description' => 'Le soleil de l\'Espagne dans une assiette.',
                'instructions' => "Faire revenir les fruits de mer.\nAjouter le riz et le safran.\nLaisser cuire sans remuer.",
                'ingredients' => [['qty' => '500g', 'name' => 'Riz rond'], ['qty' => '300g', 'name' => 'Fruits de mer'], ['qty' => '1', 'name' => 'Dosette Safran']],
                'image' => 'recipes/paella.jpg',
                'category_id' => $plat,
            ],
            [
                'title' => 'Lasagnes à la Bolognaise',
                'description' => 'Couches de pâtes, béchamel et viande mijotée.',
                'instructions' => "Préparer la sauce bolognaise.\nPréparer la béchamel.\nAlterner les couches dans un plat.",
                'ingredients' => [['qty' => '500g', 'name' => 'Pâtes Lasagne'], ['qty' => '500g', 'name' => 'Viande hachée'], ['qty' => '1L', 'name' => 'Lait']],
                'image' => 'recipes/lasagne.jpg',
                'category_id' => $plat,
            ],

            // --- DESSERTS ---
            [
                'title' => 'Tiramisu Classique',
                'description' => 'Le dessert italien au café et mascarpone.',
                'instructions' => "Fouetter le mascarpone et les oeufs.\nTremper les biscuits dans le café.\nAlterner les couches.",
                'ingredients' => [['qty' => '250g', 'name' => 'Mascarpone'], ['qty' => '3', 'name' => 'Oeufs'], ['qty' => '1', 'name' => 'Tasse Café fort']],
                'image' => 'recipes/tiramisu.jpg',
                'category_id' => $dessert,
            ],
            [
                'title' => 'Crêpes au Chocolat',
                'description' => 'Le goûter préféré des enfants et des grands.',
                'instructions' => "Mélanger farine, oeufs et lait.\nCuire dans une poêle chaude.\nGarnir de chocolat.",
                'ingredients' => [['qty' => '250g', 'name' => 'Farine'], ['qty' => '4', 'name' => 'Oeufs'], ['qty' => '50cl', 'name' => 'Lait']],
                'image' => 'recipes/crepes.jpg',
                'category_id' => $dessert,
            ],
            [
                'title' => 'Cheesecake aux Fruits Rouges',
                'description' => 'Frais, crémeux et pas trop sucré.',
                'instructions' => "Préparer la base biscuitée.\nMélanger le fromage frais.\nRéfrigérer 4h.",
                'ingredients' => [['qty' => '300g', 'name' => 'Fromage frais'], ['qty' => '150g', 'name' => 'Biscuits'], ['qty' => '100g', 'name' => 'Fruits rouges']],
                'image' => 'recipes/cheesecake.jpg',
                'category_id' => $dessert,
            ],
            [
                'title' => 'Salade de Fruits Exotiques',
                'description' => 'Une explosion de vitamines et de fraîcheur.',
                'instructions' => "Couper tous les fruits en dés.\nAjouter un peu de jus de citron.\nServir très frais.",
                'ingredients' => [['qty' => '1', 'name' => 'Mangue'], ['qty' => '1', 'name' => 'Ananas'], ['qty' => '2', 'name' => 'Kiwis']],
                'image' => 'recipes/salad.jpg',
                'category_id' => $dessert,
            ],
            [
                'title' => 'Brownie aux Noix',
                'description' => 'Fondant au chocolat avec du croquant.',
                'instructions' => "Fondre le chocolat et le beurre.\nAjouter sucre, oeufs et farine.\nCuire 20min.",
                'ingredients' => [['qty' => '200g', 'name' => 'Chocolat noir'], ['qty' => '100g', 'name' => 'Noix'], ['qty' => '150g', 'name' => 'Sucre']],
                'image' => 'recipes/brownie.jpg',
                'category_id' => $dessert,
            ]
        ];

        foreach ($recipes as $recipeData) {
            Recipe::create([
                'title' => $recipeData['title'],
                'description' => $recipeData['description'],
                'instructions' => $recipeData['instructions'],
                'ingredients' => $recipeData['ingredients'],  
                'image' => $recipeData['image'], 
                'category_id' => $recipeData['category_id'],
                'user_id' => $user->id,
            ]);
        }
    }
}
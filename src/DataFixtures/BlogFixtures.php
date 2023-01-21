<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $blog1 = new Blog();
        $blog1->setTitle('Godfather`s day');
        $blog1->setContent("Godfather ipsum dolor sit amet. I want your answer and the money by noon tomorrow. And one more thing. Don't you contact me again, ever. From now on, you deal with Turnbull. That's my family Kay, that's not me. Don't you know that I would use all of my power to prevent something like that from happening? It's a Sicilian message. It means Luca Brasi sleeps with the fishes. Very well. You want to do business with me. I will do business with you.

        What's wrong with being a lawyer? Only don't tell me you're innocent. Because it insults my intelligence and makes me very angry. Friends and money - oil and water. Vito, how do you like my little angel? Isn't she beautiful?

        If anything in this life is certain, if history has taught us anything, it is that you can kill anyone. It's not personal. It's business. I see you took the name of the town. What was your father's name? Never hate your enemies. It affects your judgment. You talk about vengeance. Is vengeance going to bring your son back to you? Or my boy to me?");
        $blog1->setAuthor($this->getReference('author1'));

        $blog2 = new Blog();
        $blog2->setTitle('Coffee mumble');
        $blog2->setContent("Cup eu instant whipped galão dark mocha seasonal. Filter to go, lungo, et body aged froth black beans. Est, blue mountain cinnamon dripper seasonal mocha bar  caffeine galão mazagran. Breve aromatic cream dripper robusta latte instant. Instant cup, et aftertaste macchiato espresso id robusta arabica sugar.
        Cultivar, single shot caffeine body half and half to go cultivar. Aged at dripper organic single origin white foam mazagran coffee. Breve strong redeye steamed in americano, seasonal blue mountain cup eu mazagran. Kopi-luwak, est, frappuccino single shot, steamed medium coffee that mocha. Percolator cinnamon con panna café au lait lungo kopi-luwak, flavour in steamed grounds shop.

        Dark aged cortado blue mountain, lungo acerbic ristretto chicory ristretto. Galão barista sweet, beans cappuccino, crema doppio con panna half and half milk. Sit spoon kopi-luwak dark so ut extra  galão. Breve, dripper ut aromatic carajillo lungo aged con panna shop. Beans to go lungo decaffeinated est strong that, saucer shop ut cup macchiato.

        Aftertaste, to go cup aromatic instant siphon lungo. Seasonal roast, grinder trifecta, shop bar , id white et spoon half and half. Medium mocha, medium, siphon barista skinny percolator grounds iced. In kopi-luwak cup carajillo spoon half and half chicory ut aftertaste turkish. Foam carajillo caffeine aroma, acerbic, dark aromatic cinnamon cortado skinny java.");
        $blog2->setAuthor($this->getReference('author2'));

        $manager->persist($blog1);
        $manager->persist($blog2);
        $manager->flush();

        $this->addReference('blog1', $blog1);
        $this->addReference('blog2', $blog2);
    }
}

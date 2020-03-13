<?php
namespace App\DataFixtures;

use App\Entity\Authors;
use App\Entity\Books;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $authors = array(new Authors("Mary Shelley"), new Authors("Jules Verne"), new Authors("Victor Hugo"));
        foreach($authors as &$a) {
            $manager->persist($a);
        }

        $b1 = new Books(
            "Frankenstein",
            $authors[0],
            new \DateTime('01-01-1818'),
            "/books/cover/Frankenstein.png",
            "Frankenstein ou Le Prométhée moderne (Frankenstein or The Modern Prometheus) est un roman gothique et considéré a posteriori comme le précurseur de la science-fiction, publié en 1818 par la jeune britannique Mary Shelley , maîtresse et future épouse du poète Shelley.. Le roman est le récit d'une tentative d'exploration polaire par Robert Walton. La majeure partie de ce récit est constituée par l'histoire de la vie de Victor Frankenstein que Walton a recueilli sur la banquise. Ce récit tourne lui même autour de la narration à Frankenstein, par le monstre auquel il a donné vie, des tourments de celui-ci, qui justifient la haine qu'il lui porte.",
            "Fiction",
            76102,
            "/books/Mary Shelley/Frankenstein - Mary Shelley.epub");

        $b2 = new Books(
            "Le Tour du Monde en Quatre-Vingts Jours",
            $authors[1],
            new \DateTime('01-01-1873'),
            "/books/cover/Le Tour du Monde en Quatre-Vingts Jours.png",
            "Phileas Fogg est un membre aussi éminent qu'original du Reform-Club de Londres. Ce gentleman lance un défi audacieux aux autres membres de cette honorable association : il parie toute sa fortune - vingt mille livres - qu'il effectuera le tour du monde en quatre-vingts jours. Il se met donc en route avec son domestique français, l'habile Passepartout, le 2 octobre 1871, à huit heures quarante-cinq. Hélas, ce départ précipité éveille la méfiance de la police. Le détective Fix soupçonne Phileas Fogg d'être l'insaisissable individu qui a volé trois jours plus tôt cinquante-cinq mille livres à la Banque d'Angleterre. Il se lance aussitôt à sa poursuite...",
            "Adventure",
            0,
            "/books/Jules Verne/Le Tour du Monde en Quatre-Vingts Jours - Jules Verne.epub");

        $b3 = new Books(
            "Vingt Mille Lieues sous les Mers",
            $authors[1],
            new \DateTime('01-01-1870'),
            "/books/cover/Vingt Mille Lieues sous les Mers.png",
            "Ce roman, parmi les plus célèbres et des plus traduits de notre littérature, apparaît sans conteste comme une des oeuvres les plus puissantes, les plus originales et les plus représentatives de Jules Verne. Tout commence en 1866 : la peur règne sur les océans. Plusieurs navires prétendent avoir rencontré un monstre effrayant. Et quand certains rentrent gravement avariés après avoir heurté la créature, la rumeur devient certitude. L'Abraham Lincoln, frégate américaine, se met en chasse pour débarrasser les mers de ce terrible danger. Elle emporte notamment le professeur Aronnax, fameux ichthyologue du Muséum de Paris, son domestique, le dévoué Conseil, et le Canadien Ned Land, «roi des harponneurs». Après six mois de recherches infructueuses, le 5 novembre 1867, on repère ce que l'on croit être un «narwal gigantesque». Mais sa vitesse rend le monstre insaisissable et lorsqu'enfin on réussit à l'approcher pour le harponner, il aborde violemment le vaisseau et le laisse désemparé. Aronnax, Conseil et Ned Land trouvent refuge sur le dos du narwal. Ils s'aperçoivent alors qu'il s'agit d'un navire sous-marin...",
            "Adventure",
            0,
            "/books/Jules Verne/Vingt Mille Lieues sous les Mers - Jules Verne.epub");

        $b4 = new Books(
            "Le Dernier Jour d’un Condamné",
            $authors[2],
            new \DateTime('01-01-1829'),
            "/books/cover/Le Dernier Jour d’un Condamné.png",
            "Un homme, bien trop jeune pour mourir, s'adresse à nous. Jugé, emprisonné, enchaîné, il a attendu sa grâce, mais elle lui a été refusée. Tout est fini. Bientôt, il montera dans la charrette et traversera la foule hideuse. La guillotine apparaîtra alors et son supplice sera cent fois pire que son crime. C'est écrit, la société le veut, la loi l'exige : avant la fin du jour, sa tête tombera dans la sciure. Avec lui nous vivons ce cauchemar, cette absurdité horrifiante de la peine capitale que personne avant Victor Hugo n'avait songé à dénoncer.",
            "Thesis novel",
            0,
            "/books/Victor Hugo/Le Dernier Jour d’un Condamné - Victor Hugo.epub");

        $books = array($b1, $b2, $b3, $b4);

        foreach($books as &$b) {
            $manager->persist($b);
        }

        $admin = new Users();
        $role = array("ROLE_ADMIN");
        $admin->setUsername("admin");
        $admin->setRoles($role);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $manager->persist($admin);

        $manager->flush();
    }
}

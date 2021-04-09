<?php


namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class adminController extends AbstractController
{

    /**
     * @Route("/admin", name="app_product_new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, SluggerInterface $slugger): Response{

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to acces admin page without having ROLE_ADMIN role');

        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();

            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash('fail', $e);
            }

            $product->setImage($newFilename);

            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'product created');

            return $this->redirectToRoute('app_product_new');

        }

        return $this->render(
            "admin/newProduct.html.twig",
            ['form' => $form->createView()]
        );
    }
}
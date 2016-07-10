<?php
namespace Ebank\Bundles\UserBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("User", pluralize=false)
 */
class UserController extends FOSRestController
{

    public function nameSuggestionAction($string)
    {

        $userRepository = $this->getDoctrine()->getRepository('UserBundle:User');

        return $this->serialize($userRepository->fullTextSearch($string));
    }

    protected function serialize($serializable)
    {

        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        if (empty($serializable)) return $this->json(null);

        if (is_object($serializable)) return $serializer->serialize($serializable, 'json');

        foreach ($serializable as $item) {
            $normalizer = new \Normalizer();
            $array[$item->getid()] = $normalizer->normalize($item);
        }

        return $this->json($array);
    }
}
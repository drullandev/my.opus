<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Scores;
use AppBundle\Entity\Topics;
use AppBundle\Entity\Reviews;

class DefaultController extends Controller
{

    // Some aditional rules...
    private $rules = array(
        'ltrim' => array('is', 'as', 'are', 'well', 'as well'),
        'trim' => array('.', ' '),
    );

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        header('Location: /admin');
        exit();
    }

    /**
     * Perform a full review of all the rateable points inside a text under a semantic criteria...
     * @Route("/review-all", name="review-all")
     */
    public function reviewAllAction()
    {

        // Recovering all the crietia and reviews to scan
        $scores = $this->getDoctrine()->getRepository(Scores::class)->findAll(array('score' => 'ASC') );
        $topics = $this->getDoctrine()->getRepository(Topics::class)->findAll();
        $reviews = $this->getDoctrine()->getRepository(Reviews::class)->findAll();

        // Combinations => rate_key + topic;
        foreach($topics as $topic) {

            foreach($scores as $score) {

                $combs[] = array('text' => "no {$topic->getValue()}", 'rate' => -1); // Single negative by 'no' nature...                

                $variants = array(
                    "{$topic->getValue()}s {$score->getValue()}", // First plural
                    "{$score->getValue()} {$topic->getValue()}s", // Second plural
                    "{$score->getValue()} {$topic->getValue()}", // Both single
                    "{$topic->getValue()} is {$score->getValue()}"); // Positive apreciation with IS

                foreach($variants as $variant) {
                    $combs[] = array('text' => $variant, 'rate' => $score->getScore()); // 
                }

            }

        }

        // Combinations => $rate_key; by itself
        foreach($scores as $score) {

            $combs[] = array('text' => $score->getValue().'s', 'rate' => $score->getScore()); // Plural
            $combs[] = array('text' => $score->getValue(), 'rate' => $score->getScore()); // Singlar

        }

        foreach($reviews as $review) { 

            $text = strtolower($review->getText());
            $this->review = array();
            $score = 0;
    
            foreach($combs as $comb) {

                if (strpos($text, $comb['text']) !== false) {

                    $this->setPreviousWord($text, $comb['text'], $match);
                    
                    $result_txt = $comb['text'];
                    if (isset($match[1])) {
                        $result_txt = "{$match[1]}$result_txt";
                    }
                    
                    $result_txt = $this->setRules($result_txt); // Setting some rules...

                    if (!empty($result_txt)) {

                        $score = $score + $comb['rate']; // Adding score

                        $rate = "{$comb['rate']}";
                        if ($comb['rate'] > 0) {
                            $rate = "+$rate";
                        }

                        $this->review[] = $result_txt.' '.$rate; // Adding ratign text...

                        $text = str_replace($result_txt, '', $text);
                        $text = str_replace($comb['text'], '', $text);
                    
                    }

                }

            }

            $review->setMyScore($score);
            $review->setMyReview($this->review);

        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        header('Location: /admin/?entity=Reviews&action=list&menuIndex=0&submenuIndex=-1&done=1');
        exit();

    }

    /**
     * @Route("/import-csv", name="import-csv")
     */
    public function importCsvAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $header = 1; // I assume the first row is allways the csv header...

        if ($request->get('import_override') == 1) {
            $em->createQuery('DELETE AppBundle:Reviews p')->execute();
        }

        // Get reviews.csv file with the data to import
        foreach($request->files as $file) { 
            if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
                while(($row = fgetcsv($handle)) !== FALSE) {
                    if ($header == 0) {    
                        $content[] = $row;

                        $rev = explode("\n",$row[3]);
                        $review = new Reviews();
                        $review->setIdHotel($row[0]);
                        $review->setText($row[2]);
                        $review->setReview($rev);
                        $review->setScore($row[4]);
                
                        $em->persist($review);
                    }
                    $header = 0;
                }
                $em->flush();
            }
        }
        
        $imported = count($content);

        if ($imported == 0) {
            return new jsonResponse(array('status'=>'success', 'msg' => "No reviews were imported at all"));
        } else {
            return new jsonResponse(array('status'=>'success', 'msg' => "{$imported} reviews where imported!. <br>Reload the list to see the changes..."));
        }

    }

    /**
     * This function get the first previous word from a determinated string inside a determinated text
     */
    private function setPreviousWord($text, $str, &$match){

        preg_match('#([^ ]+\s+)' . preg_quote($str) . '(\s[^ ]+)#i', $text, $match);
        if (in_array($this->rules['trim'], $match)) $match[0] = null;

    }

    /**
     * This function set some 'quite arbitrary' output rules or exceptions
     */
    private function setRules($txt) {
        foreach($this->rules['trim'] as $to_trim) {
            $txt = trim($txt, $to_trim);
        }

        foreach($this->rules['ltrim'] as $to_trim) {

            $txt1 = explode(' ', $txt);

            if ($txt1[0] == $to_trim) {

                unset($txt1[0]);

            }

            $txt = implode(' ', $txt1);

        }
        $txt = str_replace('.', '', $txt);
        return $txt;

    }

}

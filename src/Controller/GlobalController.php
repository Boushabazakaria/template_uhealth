<?php

namespace App\Controller;

use PDO;
use App\Entity\User;
use App\Entity\TPanier;
use App\Entity\PArticle;
use App\Entity\PDossier;
use App\Entity\PMedecin;
use App\Entity\PConvention;
use App\Entity\PRepartition;
use App\Service\CINProcessor;
use App\Entity\PGrilleTarifaireDet;
use App\Service\UserOperation;
use App\Entity\FactureDetHosix;
use App\Entity\PArticlePharmacie;
use App\Entity\PUserDossierAction;
use App\Entity\TDossierImputation;
use App\Repository\UserRepository;
use App\Entity\TDossierImputationDet;
use App\Repository\PActionRepository;
use App\Repository\PModuleRepository;
use App\Repository\PDossierRepository;
use App\Repository\POrigineRepository;
use function PHPUnit\Framework\isNull;
use App\Entity\FactureDetTechniqueHosix;
use App\Entity\TBordereauHonoraire;
use App\Entity\TDossier;
use App\Repository\PSousModuleRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\TDossierimputationDetsTechnique;
use App\Entity\TEncaissement;
use App\Entity\TEncaissementFacture;
use App\Entity\TFacture;
use App\Entity\TPanierConvention;
use App\Entity\TRendezvous;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PUserDossierActionRepository;
use App\Repository\PDossierOrganisationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Service\SyncHosixData;


class GlobalController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    private $em;




    public function __construct(Security $security , ManagerRegistry $doctrine )
    {
       $this->security = $security;
       $this->em = $doctrine->getManager();

    
    }


    #[Route('/app', name: 'app_global')]
    public function index()
    {   

        return $this->render('global/index.html.twig', [
        ]);
    }


}

<?php

namespace App\Services\Web;

use App\Services\DTO\AuditDTO;
use App\Traits\ClientUrlTrait;
use Illuminate\Support\Facades\Config;

/**
 * Class PageSpeedInsightService
 * @package App\Services\Web
 */
class PageSpeedInsightService
{
    use ClientUrlTrait;

    /**
     * PageSpeedInsightService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $testedUrl
     * @return array
     */
    public function insightAnalysisReview(string $testedUrl): array
    {
        $url = Config::get('page-speed-insight.api_url') . $testedUrl;

        $body = $this->retrieveCurlResponse(
            $this->composeBodyOptionsArray($url)
        );
        return $this->parseAnalysis(json_decode($body["response"]));
    }

    /**
     * @param \stdClass $json
     * @return array
     */
    private function parseAnalysis(\stdClass $json): array
    {
        $result = [];
//        $result["loadingExperience"] = $json->loadingExperience->overall_category ?? -1;
//        $result["originLoadingExperience"] = $json->originLoadingExperience->overall_category ?? -1;
        $result["audits"] = [];
        if (isset($json->lighthouseResult)) {
            foreach ($json->lighthouseResult->audits as $audit) {
                if (isset($audit->score)) {
                    $audit = new AuditDTO((array)$audit);
                    array_push($result["audits"], $audit);
                }
            }
        }

        return $result;
    }
}

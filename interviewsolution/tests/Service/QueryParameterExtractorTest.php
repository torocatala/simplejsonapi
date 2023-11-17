<?php

namespace App\Tests\Service;

use App\Service\QueryParameterExtractor;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class QueryParameterExtractorTest extends TestCase
{
    public function testExtract()
    {
        $request = new Request(query: [
            'isActive' => 'true',
            'isMember' => 'false',
            'lastLoginAtFrom' => '2023-01-01',
            'lastLoginAtTo' => '2023-12-31',
            'userType' => ['1', '2']
        ]);

        $extractor = new QueryParameterExtractor();
        $result = $extractor->extract($request);

        $this->assertTrue($result['isActive']);
        $this->assertFalse($result['isMember']);
        $this->assertEquals('2023-01-01', $result['lastLoginAtFrom']);
        $this->assertEquals('2023-12-31', $result['lastLoginAtTo']);
        $this->assertEquals(['1', '2'], $result['userTypes']);
    }
}

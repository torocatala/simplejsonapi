<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class QueryParameterExtractor
{
    public function extract(Request $request): array
    {
        return [
            'isActive' => $request->query->has('isActive') ? filter_var($request->query->get('isActive'), FILTER_VALIDATE_BOOLEAN) : null,
            'isMember' => $request->query->has('isMember') ? filter_var($request->query->get('isMember'), FILTER_VALIDATE_BOOLEAN) : null,
            'lastLoginAtFrom' => $request->query->get('lastLoginAtFrom'),
            'lastLoginAtTo' => $request->query->get('lastLoginAtTo'),
            'userTypes' => $request->query->all()['userType'] ?? [],
        ];
    }
}

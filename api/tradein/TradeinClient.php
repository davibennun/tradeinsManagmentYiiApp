<?php

namespace app\api\tradein;

use app\api\BaseSoapClient;
use Phpro\SoapClient\Client;
use Phpro\SoapClient\Type\RequestInterface;

class TradeinClient extends BaseSoapClient
{
    public function login(LoginRequest $request)
    {
        return $this->call('login', $request, new LoginMapper)->sessionId;
    }

    public function tradeinFormInfoPaginated(TradeinFormInfoPaginatedRequest $request)
    {
        return $this->call('tradeinFormInfoPaginated', $request, new TradeinFormInfoPaginatedResponseMapper);
    }

    public function logout(LogoutRequest $request)
    {
        return $this->call('endSession', $request);
    }
}
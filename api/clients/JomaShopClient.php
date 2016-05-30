<?php

namespace app\api\clients;


use app\api\mappers\LoginMapper;
use app\api\mappers\TradeinFormInfoPaginatedMapper;
use app\api\requests\LoginRequest;
use app\api\requests\LogoutRequest;
use app\api\requests\TradeinFormInfoPaginatedRequest;

class JomaShopClient extends BaseSoapClient
{
    public function login(LoginRequest $request)
    {
        return $this->call('login', $request, new LoginMapper)->sessionId;
    }

    public function tradeinFormInfoPaginated(TradeinFormInfoPaginatedRequest $request)
    {
        return $this->call('tradeinFormInfoPaginated', $request, new TradeinFormInfoPaginatedMapper);
    }

    public function logout(LogoutRequest $request)
    {
        return $this->call('endSession', $request);
    }
}
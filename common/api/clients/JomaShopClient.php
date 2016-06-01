<?php

namespace common\api\clients;


use common\api\mappers\LoginMapper;
use common\api\mappers\TradeinFormInfoPaginatedMapper;
use common\api\requests\LoginRequest;
use common\api\requests\LogoutRequest;
use common\api\requests\TradeinFormInfoPaginatedRequest;

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
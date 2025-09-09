<?php

use App\Filters\AuthFilter;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

final class AuthFilterTest extends CIUnitTestCase
{
    public function testRedirectsGuestToLogin(): void
    {
        $request = Services::request();
        $filter  = new AuthFilter();
        $result  = $filter->before($request);

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $result);
    }

    public function testAllowsLoggedInUser(): void
    {
        $request = Services::request();
        session()->set('user', ['id' => 1, 'role' => 'user']);
        $filter  = new AuthFilter();
        $result  = $filter->before($request);

        $this->assertNull($result);
    }

    public function testBlocksWithoutRequiredRole(): void
    {
        $request = Services::request();
        session()->set('user', ['id' => 1, 'role' => 'user']);
        $filter = new AuthFilter();
        $result = $filter->before($request, ['admin']);

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $result);
    }
}
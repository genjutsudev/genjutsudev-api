<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Helpers\Generator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Carbon;
use Sajya\Server\Exceptions\InvalidParams;
use Sajya\Server\Procedure;

class UserProcedure extends Procedure
{
    /**
     * @var int
     */
    private const LIMIT_PER_PAGE = 100;
    /**
     * @var int
     */
    private const DEFAULT_PER_PAGE = 100;

    /**
     * The name of the procedure that is used for referencing.
     *
     * @var string
     */
    public static string $name = 'user';

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function list(Request $request): array
    {
        // User::factory()->count(5000)->create();

        if (
            self::LIMIT_PER_PAGE < $perPage = $request->input('limit', self::DEFAULT_PER_PAGE)
        ) {
            throw new InvalidParams(['limit' => self::LIMIT_PER_PAGE]);
        }

        /**
         * @var Paginator $p
         */
        $p = User::query()->paginate(
            perPage: $perPage,
            page: $page = $request->input('page', 1),
        );

        return [
            'total' => $p->total(),
            'items' => $p->items(),
            'page_info' => self::pageInfo($p),
        ];
    }

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function create(RegisterRequest $request): User
    {
        return User::create(array_merge($request->all(), [
            'profilelink' => $name = uniqid(),
            'profilename' => $name,
            'type' => 'regular',
            'token' => Generator::generateToken(),
            'activity_at' => Carbon::now(),
        ]));
    }

    /**
     * for test
     *
     * @param Request $request
     *
     * @return string
     */
    public function token(Request $request): string
    {
        return Generator::generateToken($request->input('algo', 'sha256'));
    }

    /**
     * @param Paginator $paginator
     *
     * @return array{
     *  has_next_page: bool,
     *  is_first_page: bool,
     *  last_page: int,
     * }
     */
    private function pageInfo(Paginator $paginator): array
    {
        $lastPage = $paginator->lastPage();
        $currPage = $paginator->currentPage();

        return [
            'last_page' => $lastPage,
            'is_first_page' => $currPage <= 1,
            'has_next_page' => $currPage < $lastPage,
        ];
    }
}

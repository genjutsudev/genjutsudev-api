<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Sajya\Server\Exceptions\InvalidParams;
use Sajya\Server\Procedure;
use Webmozart\Assert\Assert;


class UserProcedure extends Procedure
{
    private const LIMIT_PER_PAGE = 100;
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

        // Assert::lessThanEq($perPage = $request->input('limit', self::DEFAULT_PER_PAGE), self::LIMIT_PER_PAGE);

        if (
            self::LIMIT_PER_PAGE < $perPage = $request->input('limit', self::DEFAULT_PER_PAGE)
        ) {
            throw new InvalidParams(['limit' => self::LIMIT_PER_PAGE]);
        }

        /** @var Paginator $p */
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

    private function pageInfo(Paginator $p): array
    {
        $lastPage = $p->lastPage();
        $currPage = $p->currentPage();

        return [
            'last_page' => $lastPage,
            'is_first_page' => $currPage <= 1,
            'has_next_page' => $currPage < $lastPage,
        ];
    }
}

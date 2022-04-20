<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmailTemplateRepository;
use App\Entities\EmailTemplate;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class EmailTemplateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailTemplateRepositoryEloquent extends BaseRepository implements EmailTemplateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return EmailTemplate::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }

}

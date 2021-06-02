<?php
namespace App\Core\Abstracts;

use DB;
use Str;
use Auth;
use Gate;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use App\Core\Services\MediaService;
use App\Core\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class EloquentRepository implements BaseRepository
{
    /**
     * The Entity.
     * @var Model
     */
    protected $entity;

    /**
     * The relations to eager load on every query.
     * @var array
     */
    protected $relations = [];

    /**
     * The number of models to return for pagination.
     * @var int
     */
    protected $perPage = 15;

    /**
     * Fill The Entity Prop.
     */
    public function __construct()
    {
        $this->entity = resolve($this->entity());
    }

    /**
     * Entity.
     * @return Model
     */
    abstract public function entity();

    /**
     * Get Instance From Specified Entity.
     * @return Model
     */
    public function instance() : Model
    {
        return $this->entity;
    }

    /**
     * Create New Entity.
     * @param  array $data
     * @return Model
     */
    public function eloquentCreate(array $data) : Model
    {
        $data["status"] = config("system.status.active");
        if (request()->file("file")) {
            $data["file"] = MediaService::UploadFile("files", request()->file("file"));
        }
        $entity = $this->entity->create($data);
        $singleMediaRequestFile = Str::lower($this->entity->getEntityClassName())."_create_image";
        MediaService::storeImage($entity, $singleMediaRequestFile);
        MediaService::storeMultiImages($entity, 'other_media', 'other_media_original_name');
        return $entity;
    }

    /**
     * Update Entity.
     * @param  integer $id
     * @param  array   $data
     * @return Model
     */
    public function eloquentUpdate(int $id, array $data) : Model
    {
        return tap($this->eloquentFind($id), function ($entity) use ($data) {
            $data["status"] = config("system.status.active");
            if (request()->file("edit_file")) {
                $data["file"] = MediaService::UploadFile("files", request()->file("edit_file"), $entity->file);
            }
            $singleMediaRequestFile = Str::lower($this->entity->getEntityClassName())."_edit_image";
            MediaService::updateImage($entity, $singleMediaRequestFile);
            MediaService::updateMultiImages($entity, 'edit_other_media', 'edit_other_media_original_name');
            $entity->update($data);
        });
    }

    /**
     * Delete Entity.
     * @param $id
     * @return boolean
     */
    public function eloquentDelete($id) : bool
    {
        if (is_array($id)) {
            return $this->entity->destroy($id);
        }
        $entity = $this->eloquentFind($id);
        return $entity->delete();
    }

    /**
     * restore Entity.
     * @param $id
     * @return boolean
     */
    public function eloquentRestore($id) : bool
    {
        $entity = $this->entity->withTrashed()->whereId($id)->first();
        return $entity->restore();
    }

    /**
     * Destroy Entity.
     * @param $id
     * @return boolean
     */
    public function eloquentDestroy($id) : bool
    {
        $entity = $this->entity->withTrashed()->whereId($id)->first();
        MediaService::deleteImage($entity);
        return $entity->forceDelete();
    }

    /**
     * Change Status of Enitiy
     * @return array
     */
    public function eloquentChangeStatus(int $id) : array
    {
        $entity = $this->entity->find($id);
        if ($entity->status == config("system.status.active")) {
            $entity->status = config("system.status.deactivate");
        } elseif ($entity->status == config("system.status.deactivate")) {
            $entity->status = config("system.status.active");
        }
        $entity->save();
        return [
            "case"    => $entity->status,
            "message" => (!is_array($entity->name) && $entity->name ? $entity->name : $entity->name_val) . " Is {$entity->status} Successfully"
        ];
    }

    /**
     * Get All Records From Specified Entity.
     * @return Builder
     */
    public function eloquentAll() : Builder
    {
        return $this->entity->entityFetchData($this->relations);
    }

    /**
     * The Repository Data By Sub Query.
     * @return object
     */
    public function eloquentData() : object
    {
        $resource = Str::snake(Str::plural($this->instance()->getEntityClassName()));
        return $this->eloquentPaginate()->setPath(route("admin.{$resource}.index"));
    }

    /**
     * Paginate.
     * @param  integer   $perPage
     * @return LengthAwarePaginator
     */
    public function eloquentPaginate(int $perPage = 0) : LengthAwarePaginator
    {
        $perPage = request("perPage") ?? 0;
        return $this->entity->entityFetchData($this->relations)->ordered()->paginate($perPage ?: $this->perPage);
    }

    /**
     * Find Entity By ID.
     * @param  int   $id
     * @return Model
     */
    public function eloquentFind($id) : Model
    {
        return $this->entity->with($this->relations)->findOrFail($id);
    }

    /**
     * Begin querying a model with eager loading.
     * @param  array|string  $relations
     * @return BaseRepository
     */
    public function eloquentWith(...$relations) : BaseRepository
    {
        $this->relations = $relations;
        return $this;
    }

    /**
     * Find $column Where Equals $value then get the first value.
     * @param  array $criteria
     * @return BaseRepository
     */
    public function eloquentWhere($key, $op = "=", $value) : BaseRepository
    {
        $this->entity->with($this->relations)->where($key, $op, $value);
        return $this;
    }

    /**
     * Find $column Where Equals $value.
     * @param  array $criteria
     * @return BaseRepository
     */
    public function eloquentFindWhere(array $criteria) : BaseRepository
    {
        $this->entity->with($this->relations)->where($criteria);
        return $this;
    }

    /**
     * Find $column Where Equals $value then get the first value.
     * @param  array $criteria
     */
    public function eloquentFindWhereFirst(array $criteria)
    {
        return $this->entity->where($criteria)->first();
    }
}

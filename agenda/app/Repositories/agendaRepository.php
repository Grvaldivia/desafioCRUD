<?php

namespace App\Repositories;

use App\Models\agenda;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class agendaRepository
 * @package App\Repositories
 * @version July 24, 2018, 7:53 am UTC
 *
 * @method agenda findWithoutFail($id, $columns = ['*'])
 * @method agenda find($id, $columns = ['*'])
 * @method agenda first($columns = ['*'])
*/
class agendaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'fecha',
        'hora',
        'correo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return agenda::class;
    }
}

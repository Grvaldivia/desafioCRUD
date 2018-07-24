<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateagendaRequest;
use App\Http\Requests\UpdateagendaRequest;
use App\Repositories\agendaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class agendaController extends AppBaseController
{
    /** @var  agendaRepository */
    private $agendaRepository;

    public function __construct(agendaRepository $agendaRepo)
    {
        $this->agendaRepository = $agendaRepo;
    }

    /**
     * Display a listing of the agenda.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->agendaRepository->pushCriteria(new RequestCriteria($request));
        $agendas = $this->agendaRepository->all();

        return view('agendas.index')
            ->with('agendas', $agendas);
    }

    /**
     * Show the form for creating a new agenda.
     *
     * @return Response
     */
    public function create()
    {
        return view('agendas.create');
    }

    /**
     * Store a newly created agenda in storage.
     *
     * @param CreateagendaRequest $request
     *
     * @return Response
     */
    public function store(CreateagendaRequest $request)
    {
        $input = $request->all();

        $agenda = $this->agendaRepository->create($input);

        Flash::success('Agenda saved successfully.');

        return redirect(route('agendas.index'));
    }

    /**
     * Display the specified agenda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $agenda = $this->agendaRepository->findWithoutFail($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        return view('agendas.show')->with('agenda', $agenda);
    }

    /**
     * Show the form for editing the specified agenda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $agenda = $this->agendaRepository->findWithoutFail($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        return view('agendas.edit')->with('agenda', $agenda);
    }

    /**
     * Update the specified agenda in storage.
     *
     * @param  int              $id
     * @param UpdateagendaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateagendaRequest $request)
    {
        $agenda = $this->agendaRepository->findWithoutFail($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        $agenda = $this->agendaRepository->update($request->all(), $id);

        Flash::success('Agenda updated successfully.');

        return redirect(route('agendas.index'));
    }

    /**
     * Remove the specified agenda from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $agenda = $this->agendaRepository->findWithoutFail($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        $this->agendaRepository->delete($id);

        Flash::success('Agenda deleted successfully.');

        return redirect(route('agendas.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\MachineRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class MachinesController extends Controller
{
    protected MachineRepositoryInterface $machineRepository;

    public function __construct(MachineRepositoryInterface $machineRepository)
    {
        $this->machineRepository = $machineRepository;
    }

    public function index(Request $request): JsonResponse
    {

        return rescue(function() {

            $machines = $this->machineRepository->all($this->machineRepository->all(
                paginate: true,
                length: 2
            ));

            return response()->json([
                'status' => true,
                'payload' => $machines,
                'meta' => [
                    'current_page' => $machines->currentPage(),
                    'last_page' => $machines->lastPage(),
                    'per_page' => $machines->perPage(),
                    'total' => $machines->total(),
                    'next_page_url' => $machines->nextPageUrl(),
                    'prev_page_url' => $machines->previousPageUrl(),
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], 200);
        }, function ($e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 401);
        });
    }

    public function show($id): JsonResponse
    {
        return rescue(function($id){

            $machine = $this->machineRepository->find($id);

            //get machine by id and return as json format
            return response()->json([
                'status' => true,
                'payload' => $machine ? $machine : 'Machine not found',
                'meta' => [
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], $machine ? 200 : 404);

        }, function ($e) {

            return response()->json([
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ], 402);
        });
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $machine = $this->machineRepository->create($request->validate([
                'name' => 'required|string|max:255',
                'purchase_date' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
            ]));

            //create user and return as  json format
            return response()->json([
                'data' => $machine,
                'meta' => [
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ], 402);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        return $this->machineRepository->update($id, $request->all());

        try {
            $machine = $this->machineRepository->update($id, $request->validate([
                'name' => 'required|string|max:255',
                'purchase_date' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
            ]));

            //update user and return as  json format
            return response()->json([
                'data' => ['message' => $machine ? 'Machine updated' : 'Machine not found'],
                'meta' => [
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], $machine ? 201 : 404);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ], 402);
        }
    }

    public function destroy($id): JsonResponse
    {
        $machine = $this->machineRepository->delete($id);

        try {
            //delete user and return as  json format
            return response()->json([
                'data' => ['message' => $machine ? 'Machine deleted' : 'Machine not found'],
                'meta' => [
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], $machine ? 200 : 404);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ], 402);
        }
    }

    public function search(Request $request): JsonResponse
    {
        $search = $this->machineRepository->search($request->all());

        try {
            //delete user and return as  json format
            return response()->json([
                'data' => ['message' => $search ? $search : 'Machine not found'],
                'meta' => [
                    '_timestamp' => Carbon::now()->timestamp,
                ],
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ], 402);
        }
    }
}

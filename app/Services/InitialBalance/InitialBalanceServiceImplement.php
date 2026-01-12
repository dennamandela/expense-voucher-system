<?php

namespace App\Services\InitialBalance;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\DB;
use App\Repositories\InitialBalance\InitialBalanceRepository;

class InitialBalanceServiceImplement extends Service implements InitialBalanceService{

  /**
  * don't change $this->mainRepository variable name
  * because used in extends service class
  */
  protected $mainRepository;

  public function __construct(InitialBalanceRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Define your custom methods :)

  public function getAll()
  {
    try {
      $openingBalance = $this->mainRepository->all();

      return $openingBalance;
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function getById($id)
  {
    try {
      $openingBalance = $this->mainRepository->find($id);
  
      return $openingBalance;
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function createOpeningBalance($data)
  {
    DB::beginTransaction();
    try {
      $openingBalance = $this->mainRepository->create($data);

      DB::commit();
      return $openingBalance;

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function updateOpeningBalance($id, $data)
  {
    DB::beginTransaction();
    try {
      $openingBalance = $this->mainRepository->update($id, $data);

      DB::commit();

      $openingBalance = $this->mainRepository->find($id);

      return $openingBalance;
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function deleteOpeningBalance($id)
  {
    DB::beginTransaction();
    try {
      $openingBalance = $this->mainRepository->delete($id);

      DB::commit();
      return $openingBalance;

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function getByYearAndMethod($year, $paymentMethod)
  {
    return $this->mainRepository->findByYearAndMethod($year, $paymentMethod);
  }
}

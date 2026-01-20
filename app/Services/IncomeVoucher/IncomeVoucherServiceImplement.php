<?php

namespace App\Services\IncomeVoucher;

use LaravelEasyRepository\Service;
use App\Repositories\IncomeVoucher\IncomeVoucherRepository;
use App\Repositories\IncomeDetail\IncomeDetailRepository;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class IncomeVoucherServiceImplement extends Service implements IncomeVoucherService{

    /**
    * don't change $this->mainRepository variable name
    * because used in extends service class
    */
    protected $mainRepository;
    protected $incomeDetailRepository;

    public function __construct(IncomeVoucherRepository $mainRepository, IncomeDetailRepository $incomeDetailRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->incomeDetailRepository = $incomeDetailRepository;
    }

    // Define your custom methods :)

    public function getAll($perPage = 10)
    {
      try {
        $incomeVoucher = $this->mainRepository->all($perPage);

        return $incomeVoucher;
      } catch (\Exception $e) {
        throw $e;
      }
    }

    public function printPdf($id)
    {
      try {
        $incomeVoucher = $this->mainRepository->find($id);

        if (!$incomeVoucher) {
          throw new \Exception('Income Voucher tidak ditemukan');
        }

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('chroot', public_path());

        $dompdf = new Dompdf($options);

        $html = view('income-voucher.print', compact('incomeVoucher'))->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return [
          'dompdf' => $dompdf,
          'filename' => 'BUKTI_PENERIMAAN_' . $incomeVoucher->number . '.pdf'
        ];

        } catch (\Exception $e) {
          throw $e;
        }
      }

      public function getById($id)
      {
        try {
          $incomeVoucher = $this->mainRepository->find($id);
      
          return $incomeVoucher;
        } catch (\Exception $e) {
          throw $e;
        }
      }

      public function createIncome($data)
      {
      DB::beginTransaction();

      try {

        if (empty($data['details'])) {
          throw new \Exception('Detail penerimaan wajib diisi');
        }

        $total = collect($data['details'])->sum('amount');

        $date = date('Y-m-d');

        $incomeVoucher = $this->mainRepository->create([
          'number' => $data['number'],
          'date' => $date,
          'received_from' => $data['received_from'],
          'payment_method' => $data['payment_method'],
          'total' => $total,
          'notes' => $data['notes'] ?? null
        ]);

        foreach($data['details'] as $item) {
          $this->incomeDetailRepository->create([
            'income_voucher_id' => $incomeVoucher->id,
            'description' => $item['description'],
            'amount' => $item['amount']
          ]);
        }

        DB::commit();
        return $incomeVoucher;

      } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
      }
    }

    public function updateIncome($id, $data)
    {
      DB::beginTransaction();

      try {

        $incomeVoucher = $this->mainRepository->find($id);

        if (!$incomeVoucher) {
          throw new \Exception('Income Voucher tidak ditemukan');
        }

        if (empty($data['details'])) {
          throw new \Exception('Detail penerimaan wajib diisi');
        }

        // hitung ulang total
        $total = collect($data['details'])->sum('amount');

        // update HEADER
        $this->mainRepository->update($id, [
          'received_from' => $data['received_from'],
          'payment_method' => $data['payment_method'],
          'notes' => $data['notes'] ?? null,
          'total' => $total,
        ]);

        // 🔥 HAPUS DETAIL LAMA
        $incomeVoucher->details()->delete();

        // 🔥 INSERT DETAIL BARU
        foreach ($data['details'] as $item) {
          $this->incomeDetailRepository->create([
            'income_voucher_id' => $incomeVoucher->id,
            'description' => $item['description'],
            'amount' => $item['amount'],
          ]);
        }

        DB::commit();
        return $incomeVoucher;

      } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
      }
    }

    public function deleteIncome($id)
    {
      DB::beginTransaction();
      try {
        $incomeVoucher = $this->mainRepository->find($id);

        $incomeVoucher = $this->mainRepository->delete($id);

        DB::commit();
        return $incomeVoucher;

      } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
      }
    }

    public function getSearch($data, $perPage = 10)
    {
      $search = $data['search'] ?? null;

      return $this->mainRepository->search($search, $perPage);
    }
}

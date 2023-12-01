<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $datas = DB::select('
        SELECT
            rental.id_rental,
            rental.tanggal_transaksi,
            customer.customer,
            customer.alamat_customer,
            customer.no_hp_cust,
            mobil.jenis_mobil,
            mobil.plat_nomor,
            karyawan.nama_karyawan
        FROM
            rental
        INNER JOIN
            customer ON rental.id_customer = customer.id_customer
        INNER JOIN
            mobil ON rental.id_mobil = mobil.id_mobil
        INNER JOIN
            karyawan ON rental.id_karyawan = karyawan.id_karyawan
        WHERE
            customer.customer LIKE :search
        ORDER BY
            id_rental
    ', ['search' => '%' . $search . '%']);
        return view('admin.index')->with('datas', $datas);
    }


    public function mobilindex(Request $request)
    {
        $search = $request->input('search');
        $datasmobil = DB::select('
            SELECT
                *
            FROM
                mobil
                WHERE
                deleted_at IS NULL
                AND (jenis_mobil LIKE :search)
        ', ['search' => '%' . $search . '%']);

        return view('mobil.mobil')->with('datasmobil', $datasmobil);
    }

    public function karyawanindex(Request $request)
    {
        $search = $request->input('search');
        $dataskaryawan = DB::select('
            SELECT
                *
            FROM
                karyawan
                WHERE
                deleted_at IS NULL
                AND (nama_karyawan LIKE :search)
        ', ['search' => '%' . $search . '%']);
        return view('karyawan.karyawan')->with('dataskaryawan', $dataskaryawan);
    }
    
    public function customersIndex(Request $request)
    {
        $search = $request->input('search');
        $dataCustomer = DB::select('
            SELECT
                *
            FROM
                customer
            WHERE
            deleted_at IS NULL
            AND (customer LIKE :search)
        ', ['search' => '%' . $search . '%']);
        return view('customers.customers')->with('dataCustomer', $dataCustomer);
    }
    

    public function create()
    {
        $mobilData = DB::select('SELECT * FROM mobil WHERE deleted_at IS NULL');
        $karyawanData = DB::select('SELECT * FROM karyawan WHERE deleted_at IS NULL');
        $customerData = DB::select('SELECT * FROM customer WHERE deleted_at IS NULL');
    
        return view('admin.add')
            ->with('mobilData', $mobilData)
            ->with('karyawanData', $karyawanData)
            ->with('customerData', $customerData);
        // return view('admin.add');
    }

    public function createMobil()
    {
        return view('mobil.add');
    }

    public function createkaryawan()
    {
        return view('karyawan.add');
    }

    public function createcustomer()
    {
        return view('customers.add');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'karyawan_id' => 'required',
            'mobil_id' => 'required',
        ]);
    
        // Fetch customer data
         $customerData = DB::select('SELECT * FROM customer WHERE id_customer = :customer_id', [
            'customer_id' => $request->customer_id,
        ]);
    
        // Fetch karyawan data
        $karyawanData = DB::select('SELECT * FROM karyawan WHERE id_karyawan = :karyawan_id', [
            'karyawan_id' => $request->karyawan_id,
        ]);
    
        // Fetch mobil data
        $mobilData = DB::select('SELECT * FROM mobil WHERE id_mobil = :mobil_id', [
            'mobil_id' => $request->mobil_id,
        ]);
    
        // Check if customer, karyawan, and mobil data are retrieved
        if (count($customerData) > 0 && count($karyawanData) > 0 && count($mobilData) > 0) {
            // Use the first row of customer data (assuming id_customer is unique)
            $customer = $customerData[0];
    
            // Automatically set tanggal_transaksi to the current date
            $tanggal_transaksi = Carbon::now()->toDateString();
    
            // Use the first row of karyawan data (assuming id_karyawan is unique)
            $karyawan = $karyawanData[0];
    
            // Use the first row of mobil data (assuming id_mobil is unique)
            $mobil = $mobilData[0];
    
            // Determine id_karyawan and id_mobil based on karyawan and mobil data
            $id_karyawan = $karyawan->id_karyawan;
            $id_mobil = $mobil->id_mobil;
    
            // Check if the combination of tanggal_transaksi and id_mobil already exists in rental table
            $existingRental = DB::select('
                SELECT * 
                FROM rental 
                WHERE tanggal_transaksi = :tanggal_transaksi 
                AND id_mobil = :id_mobil
            ', [
                'tanggal_transaksi' => $tanggal_transaksi,
                'id_mobil' => $id_mobil,
            ]);
    
            // If the combination already exists, handle accordingly (e.g., show an error message)
            if (count($existingRental) > 0) {
                return redirect()->route('admin.index')->with('error', 'Data rental with the same date and mobil already exists');
            }
    
            // Insert data into rental table
            DB::insert(
                'INSERT INTO rental(id_customer, tanggal_transaksi, id_karyawan, id_mobil) 
                    VALUES (:customer_id, :tanggal_transaksi, :id_karyawan, :id_mobil)',
                [
                    'customer_id' => $request->customer_id,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'id_karyawan' => $id_karyawan,
                    'id_mobil' => $id_mobil,
                ]
            );
    
            return redirect()->route('admin.index')->with('success', 'Data pesanan berhasil disimpan');
        } else {
            // Handle the case where customer, karyawan, or mobil data is not found
            return redirect()->route('admin.index')->with(['errors' => 'Data rental with the same date and mobil already exists']);
        }
    }
        
    

    public function storeMobil(Request $request)
    {
        $request->validate([
            'jenis_mobil' => 'required',
            'plat_nomor' => 'required',
        ]);
    
        DB::insert(
            'INSERT INTO mobil(jenis_mobil, plat_nomor) VALUES (:jenis_mobil, :plat_nomor)',
            [
                'jenis_mobil' => $request->jenis_mobil,
                'plat_nomor' => $request->plat_nomor,
            ]
        );
    
        return redirect()->route('mobil.mobil')->with('success', 'Data Mobil berhasil disimpan');
    }
    

    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'no_hp_karyawan' => 'required',
        ]);
    
        DB::insert(
            'INSERT INTO karyawan(nama_karyawan, alamat_karyawan, no_hp_karyawan) VALUES (:nama_karyawan, :alamat_karyawan, :no_hp_karyawan)',
            [
                'nama_karyawan' => $request->nama_karyawan,
                'alamat_karyawan' => $request->alamat_karyawan,
                'no_hp_karyawan' => $request->no_hp_karyawan,
            ]
        );
        return redirect()->route('karyawan.karyawan')->with('success', 'Data karyawan berhasil disimpan');
    }
    
    public function storeCustomer(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'alamat_customer' => 'required',
            'no_hp_cust' => 'required',
        ]);

        DB::insert(
            'INSERT INTO customer(customer, alamat_customer, no_hp_cust) 
                VALUES ( 
                    :customer, 
                    :alamat_customer, 
                    :no_hp_cust)',
            [
                'customer' => $request->customer,
                'alamat_customer' => $request->alamat_customer,
                'no_hp_cust' => $request->no_hp_cust,
            ]
        );

        return redirect()->route('customers.customers')->with('success', 'Data customer berhasil disimpan');
    }
    

    public function edit($id)
    {
        $data = DB::select('SELECT * FROM customer WHERE id_customer = :id', ['id' => $id])[0];
        return view('admin.edit')->with('data', $data);
    }

    public function editMobil($id)
    {
        $data = DB::select('SELECT * FROM mobil WHERE id_mobil = :id', ['id' => $id])[0];
        return view('mobil.edit')->with('data', $data);
    }


    public function editKaryawan($id)
    {
        $data = DB::select('SELECT * FROM karyawan WHERE id_karyawan = :id', ['id' => $id])[0];
        return view('karyawan.edit')->with('data', $data);
    }

    public function editCustomer($id)
    {
        $data = DB::select('SELECT * FROM customer WHERE id_customer = :id', ['id' => $id])[0];
        return view('customers.edit')->with('data', $data);
    }
    


    public function update($id, Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'no_hp_karyawan' => 'required',
        ]);

        DB::update(
            'UPDATE karyawan SET id_karyawan = :id_karyawan, nama_karyawan = :nama_karyawan, alamat_karyawan = :alamat_karyawan, no_hp_karyawan = :no_hp_karyawan WHERE id_karyawan = :id',
            [
                'id' => $id,
                'id_karyawan' => $request->id_karyawan,
                'nama_karyawan' => $request->nama_karyawan,
                'alamat_karyawan' => $request->alamat_karyawan,
                'no_hp_karyawan' => $request->no_hp_karyawan,
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Karyawan berhasil diubah');
    }

    public function updateMobil($id, Request $request)
        {
            $request->validate([
                'id_mobil' => 'required',
                'jenis_mobil' => 'required',
                'plat_nomor' => 'required',
            ]);
        
            DB::update(
                'UPDATE mobil SET id_mobil = :id_mobil, jenis_mobil = :jenis_mobil, plat_nomor = :plat_nomor WHERE id_mobil = :id',
                [
                    'id' => $id,
                    'id_mobil' => $request->id_mobil,
                    'jenis_mobil' => $request->jenis_mobil,
                    'plat_nomor' => $request->plat_nomor,
                ]
            );
        
            return redirect()->route('mobil.mobil')->with('success', 'Data Mobil berhasil diubah');
        }

    public function updateKaryawan($id, Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'no_hp_karyawan' => 'required',
        ]);

        DB::update(
            'UPDATE karyawan SET id_karyawan = :id_karyawan, nama_karyawan = :nama_karyawan, alamat_karyawan = :alamat_karyawan, no_hp_karyawan = :no_hp_karyawan WHERE id_karyawan = :id',
            [
                'id' => $id,
                'id_karyawan' => $request->id_karyawan,
                'nama_karyawan' => $request->nama_karyawan,
                'alamat_karyawan' => $request->alamat_karyawan,
                'no_hp_karyawan' => $request->no_hp_karyawan,
            ]
        );

        return redirect()->route('karyawan.karyawan')->with('success', 'Data Karyawan berhasil diubah');
    }
    public function updateCustomer($id, Request $request)
    {
        $request->validate([
            'id_customer' => 'required',
            'customer' => 'required',
            'alamat_customer' => 'required',
            'no_hp_cust' => 'required',
        ]);

        DB::update(
            'UPDATE customer SET id_customer = :id_customer, customer = :customer, alamat_customer = :alamat_customer, no_hp_cust = :no_hp_cust WHERE id_customer = :id',
            [
                'id' => $id,
                'id_customer' => $request->id_customer,
                'customer' => $request->customer,
                'alamat_customer' => $request->alamat_customer,
                'no_hp_cust' => $request->no_hp_cust,
            ]
        );

        return redirect()->route('customers.customers')->with('success', 'Data customer berhasil diubah');
    }

    public function delete($id)
    {
        DB::delete('DELETE FROM rental WHERE id_rental = :id_rental', ['id_rental' => $id]);
        return redirect()->route('admin.index')->with('success', 'Data Rental berhasil dihapus');
    }

    public function deleteMobil($id)
    {
        DB::delete('DELETE FROM mobil WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobil.mobil')->with('success', 'Data Mobil berhasil dihapus');
    }

    public function deleteKaryawan($id)
    {
        DB::delete('DELETE FROM karyawan WHERE id_karyawan = :id_karyawan', ['id_karyawan' => $id]);
        return redirect()->route('karyawan.karyawan')->with('success', 'Data Karyawan berhasil dihapus');
    }
    
    public function deleteCustomer($id)
    {
        DB::delete('DELETE FROM customer WHERE id_customer = :id_customer', ['id_customer' => $id]);
        return redirect()->route('customers.customers')->with('success', 'Data customer berhasil dihapus');
    }

    public function softDeleteMobil($id)
    {
        DB::update('UPDATE mobil SET deleted_at = NOW() WHERE id_mobil = :id', ['id' => $id]);
        return redirect()->route('mobil.mobil')->with('success', 'Data Mobil berhasil dihapus');
    }

    public function softDeleteKaryawan($id)
    {
        DB::update('UPDATE karyawan SET deleted_at = NOW() WHERE id_karyawan = :id', ['id' => $id]);
        return redirect()->route('karyawan.karyawan')->with('success', 'Data Karyawan berhasil dihapus');
    }
    
    public function softDeleteCustomer($id)
    {
        DB::update('UPDATE customer SET deleted_at = NOW() WHERE id_customer = :id', ['id' => $id]);
        return redirect()->route('customers.customers')->with('success', 'Data customer berhasil dihapus');
    }

    public function trashbin()
    {
        $trashbinDataMobil = DB::select('SELECT * FROM mobil WHERE deleted_at IS NOT NULL');
        $trashbinDataKaryawan = DB::select('SELECT * FROM karyawan WHERE deleted_at IS NOT NULL');
        $trashbinDataCustomer = DB::select('SELECT * FROM customer WHERE deleted_at IS NOT NULL');
    
        return view('admin.trashbin')->with('trashbinDataMobil', $trashbinDataMobil)
                                     ->with('trashbinDataKaryawan', $trashbinDataKaryawan)
                                     ->with('trashbinDataCustomer', $trashbinDataCustomer);
    }
    

    // public function trashbinKaryawan()
    // {
    //     $trashbinData = DB::select('SELECT * FROM karyawan WHERE deleted_at IS NOT NULL');
    //     return view('admin.trashbin')->with('trashbinData', $trashbinData);
    // }
    

    public function restoreMobil($id)
    {
        DB::update('UPDATE mobil SET deleted_at = NULL WHERE id_mobil = :id', ['id' => $id]);
        return redirect()->route('admin.trashbin')->with('success', 'Data Mobil berhasil direstore');
    }

    public function restoreKaryawan($id)
    {
        DB::update('UPDATE karyawan SET deleted_at = NULL WHERE id_karyawan = :id', ['id' => $id]);
        return redirect()->route('admin.trashbin')->with('success', 'Data Karyawan berhasil direstore');
    }
    
    public function restoreCustomer($id)
    {
        DB::update('UPDATE customer SET deleted_at = NULL WHERE id_customer = :id', ['id' => $id]);
        return redirect()->route('admin.trashbin')->with('success', 'Data customer berhasil direstore');
    }
    
}
<?php

namespace Modules\Agenda\Http\Controllers;

use Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon, Avatar;

use Modules\Agenda\Entities\Agenda;
use Modules\Agenda\Http\Requests\AgendaRequest;

class AgendaController extends Controller
{
    protected $title;

    /**
     * Siapkan konstruktor controller
     * 
     * @param Agenda $data
     */
    public function __construct(Agenda $data) 
    {
        $this->title = __('agenda::general.title');
        $this->data = $data;

        $this->toIndex = route('epanel.agenda.index');
        $this->prefix = 'epanel.agenda';
        $this->view = 'agenda::agenda';

        $this->tCreate = __('agenda::general.created', ['title' => $this->title]);
        $this->tUpdate = __('agenda::general.updated', ['title' => $this->title]);
        $this->tDelete = __('agenda::general.deleted', ['title' => $this->title]);

        view()->share([
            'title' => $this->title, 
            'view' => $this->view, 
            'prefix' => $this->prefix
        ]);
    }

    /**
     * Tampilkan halaman utama modul yang dipilih
     * 
     * @param Request $request
     * @return Response|View
     */
    public function index(Request $request) 
    {
        $data = $this->data->latest()->get();

        if($request->has('datatable')):
            return $this->datatable($data);
        endif;

        return view("$this->view.index", compact('data'));
    }

    /**
     * Tampilkan halaman untuk menambah data
     * 
     * @return Response|View
     */
    public function create() 
    {
        return view("$this->view.create");
    }

    /**
     * Lakukan penyimpanan data ke database
     * 
     * @param Request $request
     * @return Response|View
     */
    public function store(AgendaRequest $request) 
    {
        $data = $request->all();

        if(!$request->filled('tanggal')):
            $data['waktu_awal'] = date('Y-m-d', strtotime(Carbon::now()));
            $data['waktu_akhir'] = date('H:i', strtotime(Carbon::now()));
        else:
            $data['waktu_awal'] = date('Y-m-d', strtotime($request->tanggal));
            $data['waktu_akhir'] = date('H:i', strtotime($request->tanggal));
        endif;

        $data['id_operator'] = optional(auth()->user())->id;

        $this->data->create($data);

        notify()->flash($this->tCreate, 'success');
        return redirect($this->toIndex);
    }

    /**
     * Menampilkan detail lengkap
     * 
     * @param Int $id
     * @return Response|View
     */
    public function show($id)
    {
        # GET data by UUID
        $data = $this->data->uuid($id)->firstOrFail();

        # Tampilkan View
        return view("$this->view.ajax", compact('data'));
    }

    /**
     * Tampilkan halaman perubahan data
     * 
     * @param Int $id
     * @return Response|View
     */
    public function edit($id)
    {
        $edit = $this->data->uuid($id)->firstOrFail();
    
        return view("$this->view.edit", compact('edit'));
    }

    /**
     * Lakukan perubahan data sesuai dengan data yang diedit
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|View
     */
    public function update(AgendaRequest $request, $id)
    {    
        $edit = $this->data->uuid($id)->firstOrFail();

        $data = $request->all();

        if(!$request->filled('tanggal')):
            $data['waktu_awal'] = $edit->waktu_awal;
            $data['waktu_akhir'] = $edit->waktu_akhir;
        else:
            $data['waktu_awal'] = date('Y-m-d', strtotime($request->tanggal));
            $data['waktu_akhir'] = date('H:i', strtotime($request->tanggal));
        endif;

        $data['id_operator'] = optional(auth()->user())->id;
        
        $edit->update($data);

        notify()->flash($this->tUpdate, 'success');
        return redirect($this->toIndex);
    }

    /**
     * Lakukan penghapusan data yang tidak diinginkan
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|String
     */
    public function destroy(Request $request, $id)
    {
        if($request->has('pilihan')):
            foreach($request->pilihan as $temp):
                $each = $this->data->uuid($temp)->firstOrFail();
                $each->delete();
            endforeach;
            notify()->flash($this->tDelete, 'success');
            return redirect()->back();
        endif;
    }

    /**
     * Datatable API
     * 
     * @param  $data
     * @return Datatable
     */
    public function datatable($data) 
    {
        return datatables()->of($data)
            ->editColumn('pilihan', function($data) {
                $return  = '<span>';
                $return .= '    <div class="checkbox checkbox-only">';
                $return .= '        <input type="checkbox" id="pilihan['.$data->id.']" name="pilihan[]" value="'.$data->uuid.'">';
                $return .= '        <label for="pilihan['.$data->id.']"></label>';
                $return .= '    </div>';
                $return .= '</span>';
                return $return;
            })
            ->editColumn('label', function($data) {
                $return  = '<a href="'. route("$this->prefix.show", $data->uuid).'" data-lity>'.$data->judul.'</a>';
                $return .= '<div class="font-11 color-blue-grey-lighter">';
                $return .= '<i class="fa fa-map"></i> ' . $data->tempat . ' &nbsp; <i class="fa fa-calendar"></i> ' . tgl_indo($data->waktu_awal) . ', '. $data->waktu_akhir;
                $return .= '</div>';
                return $return;
            })
            ->editColumn('hit', function($data) {
                $return  = '<div class="font-11 color-blue-grey-lighter">HIT</div>';
                $return .= $data->view . ' Kali';
                return $return;
            })
            ->editColumn('oleh', function($data) {
                $return  = '<img src="'. Avatar::create(optional($data->operator)->nama)->toBase64() .'" ';
                $return .= '    data-toggle="tooltip" data-placement="top" data-original-title="Posted by '.optional($data->operator)->nama.'">';
                return $return;
            })
            ->editColumn('tanggal', function($data) {
                Carbon::setLocale('id');
                $return  = '<small>' . date('Y-m-d h:i:s', strtotime($data->created_at)) . '</small><br/>';
                $return .= str_replace('yang ', '', $data->created_at->diffForHumans());
                return $return;
            })
            ->editColumn('aksi', function($data) {
                $return  = '<div class="btn-toolbar">';
                $return .= '    <div class="btn-group btn-group-sm">';
                $return .= '        <a href="'. route("$this->prefix.edit", $data->uuid) .'" role="button" class="btn btn-sm btn-primary-outline">';
                $return .= '            <span class="fa fa-pencil"></span>';
                $return .= '        </a>';
                $return .= '    </div>';
                $return .= '</div>';
                return $return;
            })
            ->rawColumns(['pilihan', 'label', 'hit', 'oleh', 'tanggal', 'aksi'])->toJson();
    }
}

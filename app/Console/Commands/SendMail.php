<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\User\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new posst';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $data = Product::join('product_categories','product_categories.id','=','products.category_id')
        // ->where('flag_delete', ACTIVE)
        // ->select(
        //     'products.id',
        //     'products.sku',
        //     'products.name',
        //     'products.stock',
        //     'products.avatar',
        //     'products.expired_at',
        //     'products.category_id',
        //     'product_categories.name_category'
        // )->get();
        // $data = json_decode(json_encode($data),true);

        // Mail::to(env('MAIL_USERNAME'))->send(new \App\Mail\UserMail('user.product.emailList',$data));
    }
}

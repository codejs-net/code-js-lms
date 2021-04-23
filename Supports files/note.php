<!-- Migrate Tables -->
php artisan migrate --path=/database/migrations/2021_01_26_105651_create_libraries_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105738_create_centers_table.php
php artisan migrate --path=/database/migrations/2021_01_26_114517_create_designetions_table.php
php artisan migrate --path=/database/migrations/2021_01_26_100131_create_staff_table.php 
php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105806_create_book_dd_classes_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105846_create_book_dd_devisions_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105905_create_book_dd_sections_table.php 
php artisan migrate --path=/database/migrations/2020_10_09_135640_create_permission_tables.php
php artisan migrate --path=/database/migrations/2020_10_09_135732_create_products_table.php 
php artisan migrate --path=/database/migrations/2021_01_03_152629_create_code_table.php 
php artisan migrate --path=/database/migrations/2021_01_16_075922_create_member_cats_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075854_create_members_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075950_create_book_cats_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080044_create_book_langs_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080126_create_book_publishers_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080911_create_book_media_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075743_create_books_table.php
php artisan migrate --path=/database/migrations/2021_01_25_063419_create_settings_table.php
php artisan migrate


<!-- Seed Tables -->

php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=SettingSeeder

php artisan db:seed --class=StaffSeeder
php artisan db:seed --class=librarySeeder
php artisan db:seed --class=BookSeeder


// $resouredata = DB::table('resources')
// ->leftJoin('resource_categories', 'resources.category_id', '=', 'resource_categories.id')
// ->leftJoin('resource_types', 'resources.type_id', '=', 'resource_types.id')
// ->leftJoin('resource_creators', 'resources.cretor_id', '=', 'resource_creators.id')
// ->leftJoin('resource_publishers', 'resources.publisher_id', '=', 'resource_publishers.id')
// ->where('resources.category_id', $request->cdta)
// ->select('resources.*', 'resource_categories.category'.$lang, 'resource_types.type'.$lang, 'resource_creators.name'.$lang, 'resource_publishers.publisher'.$lang)
// ->get();

// window.open('./issue_riceipt/'+lendid, '_blank')

function printDiv1() 
    {
        $('#print_lendding').css('width', '400px');
        var divToPrint=document.getElementById('print_lendding');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>Riceipt</title>');
        newWin.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
        newWin.document.write('</head><body onload="window.print()">');
        newWin.document.write(divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},500);
    }

    // -------------------------------------------------------
                // resourceinput= $("#resourceTable tr").filter(function() {
                //     var customerId = $(this).find(".customerIDCell").html();
                // }).closest("tr");
               
                //  $('#resourceTable tr:contains("'+resourceinput+'")').addClass('text-success');
                //  $("#resourceTable .td_input:contains('" + resourceinput + "')").addClass('text-success');
// --------------------------------------------------------  

// $(function(){
    //     $("#resourceTable .td_input").filter(function() {
    //         return $(this).text() == data.lendid;
    //     }).parent('tr').remove();
    // });

    //---------------------array implode-------------------------
    $categoires=implode(',',$request->category);
        $integercat = array_map('intval', explode(',', $categoires));



        @role('Admin')
                    @if($item->name=="role-list" || $item->name=="role-create" || $item->name=="role-edit" || $item->name=="role-delete")
                @else
                    I am not a writer...
                @endrole

//------------------------------------------------------------------------------
    @hasrole('Admin')
    @foreach($roles as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
@else
    @foreach($roles as $item)
        @if($item->name!="Admin")
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
    @endforeach 
@endhasrole
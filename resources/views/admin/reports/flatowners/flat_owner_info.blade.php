<!DOCTYPE html>
<html>

   <head>
      <title>Flat Owner Information</title>

      <style>
         table td,
         table th {
            border: 0.01em solid #000000;
         }
      </style>
   </head>
    
   <body style="margin: 0px;">

      
   <div style="text-align: center;" >
         <img src="{{ public_path('samajikadmin/img/logo.png') }}" style="width: 80px; height: 80px"><br/><br/>
         <span class="logo-text">{{ __('reports.nazmahal') }}</span><br/>
         <span>{{ __('reports.building_address') }}</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('reports.flat_owner_rpt_header') }}</span></h2>
      </div>

        <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 20px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
        <tr style="background-color:#C0C0C0;">
        <th width="10%" style ="text-align: center;">{{ __('pages.tbl_sl_number_column') }}</th>
        <th width="30%">{{ __('pages.tbl_name_column') }}</th>  
        <th width="20%">{{ __('pages.nid') }}</th> 
        <th width="20%">{{ __('pages.email') }}</th> 
        <th width="20%">{{ __('pages.mobile_no') }}</th> 
        </tr>
        <?php 
        $i = 1;
        foreach($flatowners as $flatowner){
            ?>
            <tr>
            <td width="15%" style ="text-align: center;"><?php echo $i;?></td>
            <td width="65%"><?php echo $flatowner->name;?></td>
            <td width="20%"><?php echo $flatowner->nid;?></td>
            <td width="65%"><?php echo $flatowner->email;?></td>
            <td width="20%"><?php echo $flatowner->mobile_number;?></td>
            </tr>
            <?php
            $i++;

        }

        ?>
     </table>
     
   </body>
    
</html>

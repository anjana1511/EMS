@extends('layouts.app')
@section('content')
<div class="content">
	<div class="row justify-content-center">
	  <div class="col-md-10">
		<div class="card">
			 <div class="card-body">
    			<center>
    				<a href="{{ url('localization/en') }} ">English</a>||
    				<a href="{{ url('localization/guj') }}">Gujarati</a>
    			</center>	
    		</div>
    	</div>	
    </div>
</div>
    <div class="row justify-content-center">
    	
         <div class="col-md-10">
            <div class="card">
                 <div class="card-header">{{ __('app.page_title') }}</div>
                  <div class="card-body">
                   <table width="90%" height="80%"> 

				   <tr> 
				    <td>
					   <input type="text" name="firstname" class="form-control" size="15" placeholder="{{ __('app.Firstname') }}" />
					</td>
					<td>
					   <input type="text" name="middlename" size="15" class="form-control" placeholder="{{ __('app.Middlename') }}" />
					</td>
				   </tr>
				   <tr>
				    <td colspan="2">
				      <textarea class="form-control" placeholder="{{ __('app.Address') }}" ></textarea>
					</td>  
				   </tr> 
				   <tr>
				   <td>
				      <select name="state" class="form-control">
					  <option value="">{{ __('app.Select_State') }}</option>
					  </select>
				   </td>
				   <td>
				   	  <select name="dist" class="form-control">
					  <option value="">{{ __('app.Select_dist') }}</option>
					  </select>
				   </td>
				   </tr>
				   <tr>
				   <td>
				      <select name="taluka" class="form-control">
					  <option value="">{{ __('app.Select_taluka') }}</option>
					  </select>
				   </td>
				   <td>
				   	  <select name="city" class="form-control">
					  <option value="">{{ __('app.Select_city') }}</option>
					  </select>
				   </td>
				   </tr>
				   <tr>
				    <td>
				    <input type="number" class="form-control" placeholder="{{ __('app.age') }}" name="age">
					</td>
					<td>
					<input type="text" class="form-control" placeholder="{{ __('app.dob') }}" name="dob">
					</td>
				   </tr>
				   <tr>
				   				   <tr>
				   <td>
				      <select name="dept" class="form-control">
					  <option value="">{{ __('app.dept') }}</option>
					  </select>
				   </td>
				   <td>
				   	  <select name="divi" class="form-control">
					  <option value="">{{ __('app.divi') }}</option>
					  </select>
				   </td>
				   </tr>
				           <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
            <input type="submit" class="btn btn-primary" name="btninsert" value="Insert" class="btnsub" onClick="return validation();"/>
             </td>
        </tr>
				   </table>
				  </div>
		    </div>
         </div>
      </div>
</div>	  

@endsection

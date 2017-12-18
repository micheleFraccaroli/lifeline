@extends('layouts.app')

@section('content')


<div class="panel-body">
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <div class="col-md-6">
            <?php if($user_up->image == '0'){?>
                <img src="{{URL::asset('/default-profile-image.png')}}" alt="profile pictures" height="200" width="200">
            <?php }else{ ?>
                <img src="{{ asset('storage/Auth::user()->image') }}" height="200" width="200">
            <?php } ?>
        </div>
    </div>
</div>
<div class="panel-body">
    <form action="/users/pic/{{ Auth::user()->id }}" method="post"  enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <input type="file" class="form-group" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<div class="panel-body">

    <form class="form-horizontal" method="POST" action="/users/{{ Auth::user()->id }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="<?= $user_up->name ?>" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="surname" class="col-md-4 control-label">Surname</label>

            <div class="col-md-6">
                <input id="surname" type="text" class="form-control" name="surname" value="<?= $user_up->surname ?>" required>

                @if ($errors->has('surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="<?= $user_up->email ?>" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
            <label for="sex" class="col-md-4 control-label">Sex</label>

            <div class="col-md-6">
                <select name="sex" id="sex">
                	<?php 
                	if($user_up->sex == 'M') {
                		echo "<option value=\"M\" required autofocus checked>M</option>";
                		echo "<option value=\"F\" required autofocus>F</option>";
                	}
                	else {
                		echo "<option value=\"F\" required autofocus checked>F</option>";
                		echo "<option value=\"M\" required autofocus>M</option>";
                	}
                	?>
                </select>
                @if ($errors->has('sex'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('born') ? ' has-error' : '' }}">
            <label for="born" class="col-md-4 control-label">Born</label>

            <div class="col-md-6">
                <input id="born" type="date" class="form-control" name="born" value="<?= $user_up->born ?>" required autofocus>

                @if ($errors->has('born'))
                    <span class="help-block">
                        <strong>{{ $errors->first('born') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
            <label for="job" class="col-md-4 control-label">Job</label>

            <div class="col-md-6">
                <input id="job" type="text" class="form-control" name="job" value="<?= $user_up->job ?>" required autofocus>

                @if ($errors->has('job'))
                    <span class="help-block">
                        <strong>{{ $errors->first('job') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
            <label for="relation" class="col-md-4 control-label">Relation</label>

            <div class="col-md-6">
                <select name="relation" id="relation">
                	<?php 
                		if($user_up->relation == 'Single') {
                    		echo "<option value=\"Single\" required autofocus>Single</option>";
                		}
                		elseif ($user_up->relation == 'Impegnato') {
                			echo "<option value=\"Impegnato\" required autofocus>Impegnato</option>";
                		}
                		elseif ($user_up->relation == 'Sposato') {
                			echo "<option value=\"Sposato\" required autofocus>Sposato</option>";
                		}
                    	elseif ($user_up->relation == 'Ignoto') {
                    		echo "<option value=\"Ignoto\" required autofocus>Ignoto</option>";
                    	}
                	?>
                  </select>

                @if ($errors->has('relation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('relation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group"> 
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
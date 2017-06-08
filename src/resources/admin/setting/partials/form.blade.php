<div class='box-body'>
    <!-- Name -->
    <div class='row'>
        <!-- Login With -->
        <div class="form-group {{ $errors->has('login_with') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="login_with ">Login With : </label>
            <div class="col-lg-6">
                {!! Form::radio('login_with', 'email' , true) !!} Email
                {!! Form::radio('login_with', 'username' , false) !!} Username
                {!! Form::radio('login_with', 'both' , false) !!} Both
                {!! $errors->first('login_with', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('interest') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="interest ">Interests : </label>
            <div class="col-sm-6">
                {!! Form::text('interest',old('interest'),['data-role'=>'tagsinput','id'=>'tags-input']) !!}
                <span class="help-block">
                    <code>Please use " , " for add tag</code>
                </span>
                {!! $errors->first('interest', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('skill') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="skill ">Skills : </label>
            <div class="col-sm-6">
                {!! Form::text('skill',old('skill'),['data-role'=>'tagsinput','id'=>'tags-input']) !!}
                <span class="help-block">
                    <code>Please use " , " for add tag</code>
                </span>
                {!! $errors->first('skill', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="state ">State : </label>
            <div class="col-sm-6">
                {!! Form::text('state',old('state'),['data-role'=>'tagsinput','id'=>'tags-input']) !!}
                <span class="help-block">
                    <code>Please use " , " for add tag</code>
                </span>
                {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('twitter_client_id') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">twitter client id</label>
            <div class="col-lg-6">
                {!! Form::text('twitter_client_id',old('twitter_client_id'),array('class'=>'form-control')) !!}
                {!! $errors->first('twitter_client_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('twitter_client_secret') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">twitter client secret</label>
            <div class="col-lg-6">
                {!! Form::text('twitter_client_secret',old('twitter_client_secret'),array('class'=>'form-control')) !!}
                {!! $errors->first('twitter_client_secret', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('google_client_id') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">google client id</label>
            <div class="col-lg-6">
                {!! Form::text('google_client_id',old('google_client_id'),array('class'=>'form-control')) !!}
                {!! $errors->first('google_client_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('google_client_secret') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">google client secret</label>
            <div class="col-lg-6">
                {!! Form::text('google_client_secret',old('google_client_secret'),array('class'=>'form-control')) !!}
                {!! $errors->first('google_client_secret', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('facebook_client_id') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">facebook client id</label>
            <div class="col-lg-6">
                {!! Form::text('facebook_client_id',old('facebook_client_id'),array('class'=>'form-control')) !!}
                {!! $errors->first('facebook_client_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('facebook_client_secret') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">facebook client secret</label>
            <div class="col-lg-6">
                {!! Form::text('facebook_client_secret',old('facebook_client_secret'),array('class'=>'form-control')) !!}
                {!! $errors->first('facebook_client_secret', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('pinterest_client_id') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">pinterest client id</label>
            <div class="col-lg-6">
                {!! Form::text('pinterest_client_id',old('pinterest_client_id'),array('class'=>'form-control')) !!}
                {!! $errors->first('pinterest_client_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('pinterest_client_secret') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">pinterest client secret</label>
            <div class="col-lg-6">
                {!! Form::text('pinterest_client_secret',old('pinterest_client_secret'),array('class'=>'form-control')) !!}
                {!! $errors->first('pinterest_client_secret', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('linkedin_client_id') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">linkedin client id</label>
            <div class="col-lg-6">
                {!! Form::text('linkedin_client_id',old('linkedin_client_id'),array('class'=>'form-control')) !!}
                {!! $errors->first('linkedin_client_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('linkedin_client_secret') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">linkedin client secret</label>
            <div class="col-lg-6">
                {!! Form::text('linkedin_client_secret',old('linkedin_client_secret'),array('class'=>'form-control')) !!}
                {!! $errors->first('linkedin_client_secret', '<span class="help-block">:message</span>') !!}
            </div>
        </div>


        <div class="form-group {{ $errors->has('mail_driver') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail driver</label>
            <div class="col-lg-6">
                {!! Form::text('mail_driver',old('mail_driver'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_driver', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_host') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail host</label>
            <div class="col-lg-6">
                {!! Form::text('mail_host',old('mail_host'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_host', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_port') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail port</label>
            <div class="col-lg-6">
                {!! Form::text('mail_port',old('mail_port'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_port', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_username') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail username</label>
            <div class="col-lg-6">
                {!! Form::text('mail_username',old('mail_username'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_username', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_password') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail password</label>
            <div class="col-lg-6">
                {!! Form::text('mail_password',old('mail_password'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_password', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_encryption') ? 'has-error' : '' }}">
            <label class="control-label col-lg-3" for="name">mail encryption</label>
            <div class="col-lg-6">
                {!! Form::text('mail_encryption',old('mail_encryption'),array('class'=>'form-control')) !!}
                {!! $errors->first('mail_encryption', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>
</div>
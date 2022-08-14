@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',244)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('id',245)->first()->custom_text }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',247)->first()->custom_text }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ $websiteLang->where('id',248)->first()->custom_text }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="socail-tab" data-toggle="tab" href="#socail" role="tab" aria-controls="socail" aria-selected="false">{{ $websiteLang->where('id',249)->first()->custom_text }}</a>
                        </li>

                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('admin.contact-information.update',$contact->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="header">{{ $websiteLang->where('id',250)->first()->custom_text }}</label>
                                            <input type="text" name="header" class="form-control" id="header"  value="{{ $contact->header }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">{{ $websiteLang->where('id',55)->first()->custom_text }}</label>
                                            <textarea name="address" id="address" cols="30" rows="3" class="form-control" >{{ $contact->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="about">{{ $websiteLang->where('id',251)->first()->custom_text }}</label>
                                            <textarea name="about" id="about" cols="30" rows="3" class="form-control" >{{ $contact->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone">{{ $websiteLang->where('id',252)->first()->custom_text }}</label>
                                            <textarea name="phone" id="phone" cols="30" rows="3" class="form-control" >{{ $contact->phones }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">{{ $websiteLang->where('id',253)->first()->custom_text }}</label>
                                            <textarea name="email" id="email" cols="30" rows="3" class="form-control" >{{ $contact->emails }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="map_embed_code">{{ $websiteLang->where('id',254)->first()->custom_text }}</label>
                                            <textarea name="map_embed_code" id="map_embed_code" class="form-control" cols="30" rows="5" >{{ $contact->map_embed_code }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="emails">{{ $websiteLang->where('id',255)->first()->custom_text }}</label>
                                            <input type="text" name="copyright" class="form-control" id="copyright"  value="{{ $contact->copyright }}">
                                        </div>
                                    </div>



                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('admin.topbar.contact',$contact_us->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="topbar_phone">{{ $websiteLang->where('id',256)->first()->custom_text }}</label>
                                            <input type="text" name="topbar_phone" class="form-control" id="topbar_phone"  value="{{ $contact_us->topbar_phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="topbar_email">{{ $websiteLang->where('id',257)->first()->custom_text }}</label>
                                            <input type="text" name="topbar_email" id="topbar_email" class="form-control" value="{{ $contact_us->topbar_email }}">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route('admin.footer.contact',$contact_us->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="footer_phone">{{ $websiteLang->where('id',258)->first()->custom_text }}</label>
                                            <input type="text" name="footer_phone" class="form-control" id="footer_phone"  value="{{ $contact_us->footer_phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="footer_email">{{ $websiteLang->where('id',259)->first()->custom_text }}</label>
                                            <input type="text" name="footer_email" id="footer_email" class="form-control" value="{{ $contact_us->footer_email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="footer_address">{{ $websiteLang->where('id',260)->first()->custom_text }}</label>
                                            <input type="text" name="footer_address" id="footer_address" class="form-control" value="{{ $contact_us->footer_address }}">
                                        </div>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="socail" role="tabpanel" aria-labelledby="socail-tab">
                            <form action="{{ route('admin.social.link',$contact_us->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook">{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                                            <input type="text" name="facebook" class="form-control" id="facebook"  value="{{ $contact_us->facebook }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                                            <input type="text" name="twitter" class="form-control" id="twitter"  value="{{ $contact_us->twitter }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram">{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                                            <input type="text" name="instagram" class="form-control" id="instagram"  value="{{ $contact_us->instagram }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="linkedin">{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                                            <input type="text" name="linkedin" class="form-control" id="linkedin"  value="{{ $contact_us->linkedin }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="youtube">{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                                            <input type="text" name="youtube" class="form-control" id="youtube"  value="{{ $contact_us->youtube }}">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </form>
                        </div>

                      </div>
                </div>
            </div>
        </div>
    </div>

@endsection

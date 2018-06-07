<div class="post_lk  post{{$ad->id}}">
            <div class="row">
              <div class="title-annoucement">
                 <div class="post-a-h3" style="">
                     <a href="/post/{{$ad->id}}"><h3>{{$ad->title}}</h3></a>
                 </div>
                 <div class="moder-user-post">
                    @if((Auth::check()) && (($ad->id_user===$user->id)||($user->hasRole('admin'))))
                         <div class="div-moderator">
                         <a href="/post/edit/{{$ad->id}}"  title="Редактировать объявления"><span class="glyphicon glyphicon-pencil"></span></a>
                         <span class="post-delete glyphicon glyphicon-remove" data-post-id="{{$ad->id}}" title="Удалить объявления"></span>
                         </div>
                    @endif
                 </div>
                 </div>
              <div class="foto_priv col-xs-3 col-md-3">
                  <a href="/post/{{$ad->id}}">
                    <img class="img-responsive" src="/{{$ad->preview_foto}}"/>
                  </a>
              </div>
              <div class="text_priv  col-sm-9 col-md-9 col-xs-12">
                 <div class="title_zag">
                 <div class="pyti_post">
                     {{$ad->CategoryGet(' ')}}
                 </div>
                 <div class="site">
                     Город:  {{$ad->GeographyGet()}}
                 </div>
                 </div>
                    <div class="text_post">
                        $ad->DateVchera($post->created_at, false
                    </div>
             </div>
            </div>
</div>

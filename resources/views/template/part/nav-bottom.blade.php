@if(Auth::user()->role_level==3){
<style>
.app-footer{
	display:block;
	position:fixed;
	bottom:0px;
	min-width:100%;
}
</style>
<div class="app-footer">
              <div class="app-footer__inner">
                <div class="app-footer-left">
                  <div class="footer-dots">
                    <div class="dots-separator"></div>
                    <div class="dropdown" align="center"><a href="{{ route('absensi.index') }}" class="dot-btn-wrapper" ><i class="dot-btn-icon lnr-pencil icon-gradient bg-happy-itmeo"></i></a>
                      Absen
                    </div>
                    <div class="dots-separator"></div>
                    <div class="dropdown" align="center"><a href="{{ route('cuti.index') }}" class="dot-btn-wrapper dd-chart-btn-2"><i class="dot-btn-icon lnr-calendar-full icon-gradient bg-love-kiss"></i>
                       </a>
                      Cuti
                    </div>
					<div class="dots-separator"></div>
                    <div class="dropdown" align="center"><a href="{{ route('history.index') }}" class="dot-btn-wrapper dd-chart-btn-2"><i class="dot-btn-icon lnr-list icon-gradient bg-love-kiss"></i>
                      </a>
                      History
                    </div>
					<div class="dots-separator"></div>
                    <div class="dropdown" align="center"><a href="{{ route('idcard.index') }}" class="dot-btn-wrapper dd-chart-btn-2"><i class="dot-btn-icon lnr-license icon-gradient bg-love-kiss"></i>
                      </a>
                      Id Card
                    </div>
					<div class="dots-separator"></div>
                    <div class="dropdown" align="center"><a href="{{ route('profile.index') }}" class="dot-btn-wrapper dd-chart-btn-2"><i class="dot-btn-icon lnr-user icon-gradient bg-love-kiss"></i>
                      </a>
                      Profile
                    </div>
                  </div>
                </div>
              </div>
            </div>
@else
<div class="app-footer">
              <div class="app-footer__inner">
                <div class="app-footer-left">
                  <div class="footer-dots">
				  {{Config::get('site.sitetitle')}} &copy; at {{date('Y')}} by theo
                  </div>
                </div>
              </div>
            </div>
@endif
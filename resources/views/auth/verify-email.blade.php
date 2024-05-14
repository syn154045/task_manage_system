<x-layouts.global title="verifing...">
    <!-- component -->
    <div class="w-11/12 mx-auto bg-gray-100 flex items-center justify-center rounded-lg">
        <div class="w-4/5 max-w-screen-sm p-6">
            <h1 class="text-3xl font-semibold mb-6 text-black text-center">Verify Your E-mail</h1>
            
            <div class="mt-4 text-sm text-gray-600">
                @if (session('status') == 'verification-link-sent')
                    <div class="rounded-lg bg-green-800 p-4 leading-3 text-white opacity-100" role="alert">
                        'A fresh verification link has been sent to your email address.
                    </div>
                @endif
                
                Before proceeding, please check your email for a verification link.<br/>
                If you did not receive the email ;
                <form action="{{ route('verification.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <button type="submit" class="text-green-600 rounded-md hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                        Click here to request another
                    </button>
                </form>
                
                This page can be closed.<br/>
                Or, click the top left button "Willow tit"<br/>
                to blowser back to Top page..
                
            </div>
        </div>
    </div>
</x-layouts.global>

<div>
    <h3>Data Report</h3>
    <p>Total number of services in OUR database is: {{ $ourCount }}</p>
    <p>Total number of services in THEIR API is: {{ $theirCount }}</p>
    
    <h3>These are the titles of those services that are not present on the API anymore</h3>
    <ul>
        @if($oldProducts)
            @foreach($oldProducts as $oldProduct)
                <li>{{ $oldProduct->title }}</li>
            @endforeach
        @endif
    </ul>
</div>
{{--Partial for simple lists where items have a name attribute--}}
@forelse($items as $item)
   {{link_to("$type/$item->id", "$item->name")}}<br />
@empty
    <p>There are no items to display</p>
@endforelse
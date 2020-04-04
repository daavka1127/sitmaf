@extends('layouts.layout_main')

@section('content')
<style media="screen">
table {
margin: 1em 0;
border-collapse: collapse;
border: 0.1em solid #d6d6d6;
}

caption {
text-align: left;
font-style: italic;
padding: 0.25em 0.5em 0.5em 0.5em;
}

th,
td {
padding: 0.25em 0.5em 0.25em 1em;
vertical-align: text-top;
text-align: left;
text-indent: -0.5em;
}

th {
vertical-align: bottom;
background-color: #666;
color: #fff;
}

tr:nth-child(even) th[scope=row] {
background-color: #f2f2f2;
}

tr:nth-child(odd) th[scope=row] {
background-color: #fff;
}

tr:nth-child(even) {
background-color: rgba(0, 0, 0, 0.05);
}

tr:nth-child(odd) {
background-color: rgba(255, 255, 255, 0.05);
}

td:nth-of-type(2) {
font-style: italic;
}

th:nth-of-type(3),
td:nth-of-type(3) {
text-align: right;
}

/* Fixed Headers */

th {
position: -webkit-sticky;
position: sticky;
top: 0;
z-index: 2;
}

th[scope=row] {
position: -webkit-sticky;
position: sticky;
left: 0;
z-index: 1;
}

th[scope=row] {
vertical-align: top;
color: inherit;
background-color: inherit;
background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);
}

table:nth-of-type(2) th:not([scope=row]):first-child {
left: 0;
z-index: 3;
background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);
}


/* Standard Tables */

table {
margin: 1em 0;
border-collapse: collapse;
border: 0.1em solid #d6d6d6;
}

caption {
text-align: left;
font-style: italic;
padding: 0.25em 0.5em 0.5em 0.5em;
}

th,
td {
padding: 0.25em 0.5em 0.25em 1em;
vertical-align: text-top;
text-align: left;
text-indent: -0.5em;
}

th {
vertical-align: bottom;
background-color: #666;
color: #fff;
}

tr:nth-child(even) th[scope=row] {
background-color: #f2f2f2;
}

tr:nth-child(odd) th[scope=row] {
background-color: #fff;
}

tr:nth-child(even) {
background-color: rgba(0, 0, 0, 0.05);
}

tr:nth-child(odd) {
background-color: rgba(255, 255, 255, 0.05);
}

td:nth-of-type(2) {
font-style: italic;
}

th:nth-of-type(3),
td:nth-of-type(3) {
text-align: right;
}

/* Fixed Headers */

th {
position: -webkit-sticky;
position: sticky;
top: 0;
z-index: 2;
}

th[scope=row] {
position: -webkit-sticky;
position: sticky;
left: 0;
z-index: 1;
}

th[scope=row] {
vertical-align: top;
color: inherit;
background-color: inherit;
background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);
}

table:nth-of-type(2) th:not([scope=row]):first-child {
left: 0;
z-index: 3;
background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);
}

/* Strictly for making the scrolling happen. */

th[scope=row] + td {
min-width: 24em;
}

th[scope=row] {
min-width: 20em;
}

.table-div{
  overflow:auto;
  width:50%;
  height:300px;
  padding: 5px;
}
</style>

<h2>Row Headers</h2>
<div class="table-div">
  <table>

    <thead>
      <tr>
        <th>Author</th>
        <th>Title</th>
        <th>Year</th>
        <th>ISBN-13</th>
        <th>ISBN-10</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Miguel De Cervantes</th>
        <td >The Ingenious Gentleman Don Quixote of La Mancha</td>
        <td>1605</td>
        <td>9783125798502</td>
        <td>3125798507</td>
      </tr>
      <tr>
        <th scope="row">Gabrielle-Suzanne Barbot de Villeneuve</th>
        <td>La Belle et la Bête</td>
        <td>1740</td>
        <td>9781910880067</td>
        <td>191088006X</td>
      </tr>
      <tr>
        <th scope="row">Sir Isaac Newton</th>
        <td>The Method of Fluxions and Infinite Series: With Its Application to the Geometry of Curve-lines</td>
        <td>1763</td>
        <td>9781330454862</td>
        <td>1330454863</td>
      </tr>
      <tr>
        <th scope="row">Mary Shelley</th>
        <td>Frankenstein; or, The Modern Prometheus</td>
        <td>1818</td>
        <td>9781530278442</td>
        <td>1530278449</td>
      </tr>
      <tr>
        <th scope="row">Herman Melville</th>
        <td>Moby-Dick; or, The Whale</td>
        <td>1851</td>
        <td>9781530697908</td>
        <td>1530697905</td>
      </tr>
      <tr>
        <th scope="row">Emma Dorothy Eliza Nevitte Southworth</th>
        <td>The Hidden Hand</td>
        <td>1888</td>
        <td>9780813512969</td>
        <td>0813512964</td>
      </tr>
      <tr>
        <th scope="row">F. Scott Fitzgerald</th>
        <td>The Great Gatsby</td>
        <td>1925</td>
        <td>9780743273565</td>
        <td>0743273567</td>
      </tr>
      <tr>
        <th scope="row">George Orwell</th>
        <td>Nineteen Eighty-Four</td>
        <td>1948</td>
        <td>9780451524935</td>
        <td>0451524934</td>
      </tr>
      <tr>
        <th scope="row">Nnedi Okorafor</th>
        <td>Who Fears Death</td>
        <td>2010</td>
        <td>9780756406691</td>
        <td>0756406692</td>
      </tr>
    </tbody>
  </table>
</div>

@endsection

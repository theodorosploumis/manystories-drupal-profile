## SPARQL Endpoint

### About SPARQL

Another advanced method to get the Stories from the website except from the [RESTful API](http://manystoriesoneheart.gr/api) is to use the public [SPARQL](https://www.wikiwand.com/en/SPARQL) Endpoint under [/sparql](http://manystoriesoneheart.gr/sparql).

On the same url there is an interface available which implements [SPARQL](http://www.w3.org/TR/rdf-sparql-query/) and [SPARQL+](https://github.com/semsol/arc2/wiki/SPARQL%2B) via [HTTP Bindings](http://www.w3.org/TR/rdf-sparql-protocol/#query-bindings-http).

SPARQL is an RDF query language, that is, a semantic query language for databases, able to retrieve and manipulate data stored in Resource Description Framework ([RDF](https://www.wikiwand.com/en/Resource_Description_Framework)) format.
It is one of the key technologies of the semantic web.

SPARQL allows for a query to consist of triple patterns, conjunctions, disjunctions, and optional patterns.

We use this technology not only to expose the Stories to the public but also to offer completely Linked data to everyone interested.

### Public SPARQL Endpoint

The public SPARQL Endpoint can be accessed at url [/sparql](http://manystoriesoneheart.gr/sparql).

Here are some examples of SPARQL Queries you can run on the endpoint.

> If you are just starting with SPARQL and Linked data here we propose a really good article to read: [Using SPARQL to access Linked Open Data](http://programminghistorian.org/lessons/graph-databases-and-SPARQL)

#### 1. Get the first 100 triples for Pages and Stories

```
SELECT * WHERE {
  GRAPH ?g { ?s ?p ?o . }
}
LIMIT 100

```

#### 2. Get the 10 latest Stories that have the category (keywords) "Gastronomy"

```
PREFIX schema: <https://schema.org/>

SELECT ?Story WHERE {
  GRAPH ?graph { ?Story schema:keywords <http://manystoriesoneheart.gr/stories/gastronomy> . }
}
LIMIT 10
```

#### 3. Get the latest 10 Stories that have an Event date and happened on September 2015 (01 - 31 Sept. 2015 UTC)

```
PREFIX schema: <https://schema.org/>

SELECT ?Story WHERE {
  GRAPH ?graph {
    ?Story ?has ?startDate .
    ?startDate schema:startDate ?value .
    FILTER(?value >= "1441065600" && ?value <= "1443657600")
  }
}
LIMIT 10
```

#### 4. Get the 10 latest Stories that have the word "Remember" as a call to action

```
PREFIX schema: <https://schema.org/>

SELECT ?Story WHERE {
  GRAPH ?graph {
    ?Story schema:potentialAction ?actionText .
    FILTER(?actionText = "Remember")
  }
}
LIMIT 10
```

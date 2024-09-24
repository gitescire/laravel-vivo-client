# Laravel VIVO Client

This is a Laravel VIVO client to send data between platforms. 

## Installation
You can install this plugin using composer
~~~
composer require gitescire/laravel-vivo-client
~~~

## Seting up Laravel environment
You should add this variables with your VIVO administration information into ***.env*** file
~~~
# API test mode to prepare platforms. Must be false in production
LVC_TEST_MODE=false
# VIVO API URL base
LVC_URL_VIVO
# VIVO root/admin gmail 
LVC_EMAIL_USER_VIVO
# VIVO root/admin password 
LVC_PASSWORD_USER_VIVO
# Default VIVO graph
LVC_GRAPH_VIVO
# Individual URL base
LVC_INDIVIDUAL_URL_VIVO
~~~
This variables makes plugin can connect to VIVO backend and make requests to its API.

___

# Queries examples

-To create
~~~
PREFIX vivo: <http://vivoweb.org/ontology/core#>
INSERT DATA {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> vivo:label "New person" .
    }
}
~~~

-To read
~~~
PREFIX vivo: <http://vivoweb.org/ontology/core#>
SELECT ?s ?p ?o 
WHERE { 
    GRAPH <http://example.org/graph> { 
        ?s ?p ?o 
    } 
}
~~~

-To update
~~~
PREFIX vivo: <http://vivoweb.org/ontology/core#>
DELETE { 
    GRAPH <http://example.org/graph> { 
        <http://example.org/individual/n123> vivo:label ?oldLabel .
    }
} 
INSERT { 
    GRAPH <http://example.org/graph> { 
        <http://example.org/individual/n123> vivo:label 'Modified person' .
    }
} 
WHERE { 
    GRAPH <http://example.org/graph> { 
        <http://example.org/individual/n123> vivo:label ?oldLabel .
    }
}
~~~

-To delete
~~~
PREFIX vivo: <http://vivoweb.org/ontology/core#>
DELETE { 
    GRAPH <http://example.org/graph> { 
        <http://example.org/individual/n123> vivo:label ?oldLabel .
    }
} 
WHERE { 
    GRAPH <http://example.org/graph> { 
        <http://example.org/individual/n123> vivo:label ?oldLabel .
    }
}
~~~

-To create a person with data
~~~
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX lomes: <http://example.org/lomes#>
INSERT DATA {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> 
            dc:audience.educationLevel "Nivel educativo" ;
            dc:contributor.author "Autor" ;
            dc:contributor.departament "Departamento académico" ;
            dc:coverage "Ámbito" ;
            dc:date.created "Fecha de creación" ;
            dc:description.abstract "Resumen" ;
            dc:description.notes "Anotación" ;
            dc:extent "Duración" ;
            dc:identifier.orcid "ORCID ID del autor" ;
            dc:identifier.uri "Handle / DOI" ;
            dc:language.iso "Idioma" ;
            dc:relation.embedded "Video incorporado" ;
            dc:relation "Patrocinadores" ;
            dc:rights.uri "Condiciones de Licencia" ;
            dc:rights "Nivel de Acceso" ;
            dc:subject.discipline "Disciplina" ;
            dc:subject.keyword "Palabras clave" ;
            dc:subject.lcsh "Materia de la Biblioteca del Congreso" ;
            dc:subject.other "Competencia" ;
            dc:subject "Asignatura relacionada" ;
            dc:title "Título" ;
            dc:type "Tipo de recurso" ;
            lomes:classification.taxonPath "Accesibilidad" ;
            lomes:educational.cognitiveProcess "Proceso cognitivo" ;
            lomes:educational.context "Contexto" ;
            lomes:educational.description "Descripción de uso educativo" ;
            lomes:educational.intentedEndUserRole "Destinatario" ;
            lomes:educational.interactivityLevel "Nivel de Interactividad" ;
            lomes:educational.interactivityType "Tipo de Interactividad" ;
            lomes:educational.learningResourceType "Tipo de Recurso Educativo" ;
            lomes:educational.semanticDensity "Densidad semántica" ;
            lomes:educational.typicalAgeRange "Rango típico de edad" ;
            lomes:general.aggregationLevel "Nivel de Agregación" ;
            lomes:general.structure "Estructura" ;
            lomes:lifeCycle.status "Estado" ;
            lomes:lifeCycle.version "Versión" ;
            lomes:technical.installationRemarks "Pautas de Instalación" .
    }
}
~~~

-To read a person with data
~~~
PREFIX dc: <http://purl.org/dc/elements/1.1/>
SELECT ?educationLevel ?author
WHERE {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> 
            dc:audience.educationLevel ?educationLevel ;
            dc:contributor.author ?author .
    }
}
~~~

-To update a person with data
~~~
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX lomes: <http://example.org/lomes#>
DELETE {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> 
            dc:audience.educationLevel ?oldEducationLevel ;
            dc:contributor.author ?oldAuthor .
    }
}
INSERT {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> 
            dc:audience.educationLevel "Nuevo Nivel Educativo" ;
            dc:contributor.author "Nuevo Autor" .
    }
}
WHERE {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> 
            dc:audience.educationLevel ?oldEducationLevel ;
            dc:contributor.author ?oldAuthor .
    }
}
~~~

-To delete a person with data
~~~
DELETE {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> ?p ?o .
    }
}
WHERE {
    GRAPH <http://example.org/graph> {
        <http://example.org/individual/n123> ?p ?o .
    }
}
~~~

___
SELECT 
    patho.idp AS idp,

    CASE 
        WHEN patho.type LIKE 'l%' THEN 'Pathologie des branches (voies luo)'
        WHEN patho.type LIKE 'j%' THEN 'Pathologies des tendino–musculaires (jing jin)'
        WHEN patho.type LIKE 'tf%' THEN 'Pathologies d’organe/viscère (tsang/fu)'
        WHEN patho.type LIKE 'mv%' THEN 'Pathologies des merveilleux vaisseaux'
        WHEN patho.type LIKE 'm%' THEN 'Pathologies de méridien'
        ELSE 'autre'
    END AS categorie,

    patho.mer AS mer,
    patho.type AS code_type,

    CASE 
        WHEN patho.type LIKE 'mv' THEN 'Néant'
        WHEN patho.type LIKE 'mvi' THEN 'Inférieure'
        WHEN patho.type LIKE 'mva' THEN 'Antérieure'
        WHEN patho.type LIKE 'mvp' THEN 'Postérieure'
        
        WHEN patho.type LIKE 'j' THEN 'Néant'
        
        WHEN patho.type LIKE '%pcs' THEN 'Supérieur, Plein et Chaud'
        WHEN patho.type LIKE '%pcm' THEN 'Moyen, Plein et Chaud'
        WHEN patho.type LIKE '%pci' THEN 'Inférieur, Plein et Chaud'
        WHEN patho.type LIKE '%pc' THEN 'Plein et Chaud'
        
        WHEN patho.type LIKE '%vfs' THEN 'Supérieur, Vide et Froid'
        WHEN patho.type LIKE '%vfm' THEN 'Moyen, Vide et Froid'
        WHEN patho.type LIKE '%vfi' THEN 'Inférieur, Vide et Froid'
        WHEN patho.type LIKE '%vf' THEN 'Vide et Froid'
        
        WHEN patho.type LIKE '%c%' THEN 'Chaud'
        WHEN patho.type LIKE '%e%' THEN 'Externe'
        WHEN patho.type LIKE '%i%' THEN 'Interne'
        WHEN patho.type LIKE '%p%' THEN 'Plein'
        WHEN patho.type LIKE '%v%' THEN 'Vide'
        WHEN patho.type LIKE '%f%' THEN 'Froid'
        ELSE NULL
    END AS type,

    patho.desc AS description

FROM patho;

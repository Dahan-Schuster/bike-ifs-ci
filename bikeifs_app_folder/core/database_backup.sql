toc.dat                                                                                             0000600 0004000 0002000 00000007441 13562536246 0014461 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP       !                
    w            bikeifs    11.5    11.5     v           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false         w           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false         x           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false         y           1262    16393    bikeifs    DATABASE     �   CREATE DATABASE bikeifs WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE bikeifs;
             postgres    false         q          0    16658    ADMINISTRADOR 
   TABLE DATA                     public       postgres    false    211       2929.dat e          0    16554 	   BICICLETA 
   TABLE DATA                     public       postgres    false    199       2917.dat o          0    16637    EMAIL 
   TABLE DATA                     public       postgres    false    209       2927.dat i          0    16586    FUNCIONARIO 
   TABLE DATA                     public       postgres    false    203       2921.dat m          0    16614    REGISTRO 
   TABLE DATA                     public       postgres    false    207       2925.dat r          0    16673 
   REQUISICAO 
   TABLE DATA                     public       postgres    false    212       2930.dat k          0    16600    SAIDA 
   TABLE DATA                     public       postgres    false    205       2923.dat g          0    16571    TagRFID 
   TABLE DATA                     public       postgres    false    201       2919.dat c          0    16535    USUARIO 
   TABLE DATA                     public       postgres    false    197       2915.dat �           0    0    ADMINISTRADOR_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public."ADMINISTRADOR_id_seq"', 4, true);
            public       postgres    false    210         �           0    0    BICICLETA_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."BICICLETA_id_seq"', 606, true);
            public       postgres    false    198         �           0    0    EMAIL_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."EMAIL_id_seq"', 1, false);
            public       postgres    false    208         �           0    0    FUNCIONARIO_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."FUNCIONARIO_id_seq"', 1, true);
            public       postgres    false    202         �           0    0    REGISTRO_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."REGISTRO_id_seq"', 17, true);
            public       postgres    false    206         �           0    0    REQUISICAO_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public."REQUISICAO_id_seq"', 4, true);
            public       postgres    false    213         �           0    0    SAIDA_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."SAIDA_id_seq"', 22, true);
            public       postgres    false    204         �           0    0    TagRFID_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."TagRFID_id_seq"', 159, true);
            public       postgres    false    200         �           0    0    USUARIO_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public."USUARIO_id_seq"', 1400, true);
            public       postgres    false    196                                                                                                                                                                                                                                       2929.dat                                                                                            0000600 0004000 0002000 00000000545 13562536246 0014277 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."ADMINISTRADOR" VALUES (2, 'Dahan Schuster', 'dahanneto@gmail.com', '077.132.735-81', '$2y$10$h6OokDQ.9S2F4zZjyui6I.pVz5x8CcHBH5d3VqWRJZ1DjqSLudE/K');
INSERT INTO public."ADMINISTRADOR" VALUES (1, 'Danielly Silva do Nascimento', 'fanisz__@hotmail.com', '076.838.705-10', '$2y$10$NvM5r0/fwgtRez13GDD0QO/gINggndV0dSjeyTlM9OfKyojJ2QvUO');


                                                                                                                                                           2917.dat                                                                                            0000600 0004000 0002000 00000133051 13562536246 0014273 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."BICICLETA" VALUES (5, 'repeating-linear-gradient(45deg, #00FFFF 0% 25%, #00BFFF 25% 50%, #0042F8 50% 75%, #0C00B3 75% 100%)', 8, 'Azula', 'Azul da cor do mar.', 24, 0, 1, NULL, true);
INSERT INTO public."BICICLETA" VALUES (6, 'repeating-linear-gradient(45deg, #0042F8 0% 100%)', 3, 'Shimano', 'Nenhuma observação', 26, 0, 1, '/public/img/bikes/fixie-bike.jpg', true);
INSERT INTO public."BICICLETA" VALUES (2, 'repeating-linear-gradient(45deg, #C0C0C0 0% 33.333333333333336%, #000000 33.333333333333336% 66.66666666666667%, #800080 66.66666666666667% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1, NULL, true);
INSERT INTO public."BICICLETA" VALUES (408, 'repeating-linear-gradient(45deg, #7D6F64 0% 100%)', 8, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1202, NULL, true);
INSERT INTO public."BICICLETA" VALUES (409, 'repeating-linear-gradient(45deg, #AB222D 0% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1203, NULL, true);
INSERT INTO public."BICICLETA" VALUES (410, 'repeating-linear-gradient(45deg, #B0510B 0% 33.333333333333%, #A3A93C 33.333333333333% 66.666666666667%, #7252B0 66.666666666667% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1204, NULL, true);
INSERT INTO public."BICICLETA" VALUES (411, 'repeating-linear-gradient(45deg, #DE7318 0% 50%, #8173ED 50% 100%)', 7, 'Shimano', NULL, 20, 0, 1205, NULL, true);
INSERT INTO public."BICICLETA" VALUES (412, 'repeating-linear-gradient(45deg, #4EA9BC 0% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1206, NULL, true);
INSERT INTO public."BICICLETA" VALUES (413, 'repeating-linear-gradient(45deg, #A2690E 0% 33.333333333333%, #9C14ED 33.333333333333% 66.666666666667%, #78EFA0 66.666666666667% 100%)', 3, 'Scott', NULL, 20, 0, 1207, NULL, true);
INSERT INTO public."BICICLETA" VALUES (414, 'repeating-linear-gradient(45deg, #DE4FC6 0% 50%, #84E32A 50% 100%)', 3, 'Shimano', NULL, 20, 0, 1208, NULL, true);
INSERT INTO public."BICICLETA" VALUES (415, 'repeating-linear-gradient(45deg, #7A006D 0% 100%)', 8, NULL, NULL, 20, 0, 1209, NULL, true);
INSERT INTO public."BICICLETA" VALUES (416, 'repeating-linear-gradient(45deg, #17C3E4 0% 100%)', 4, NULL, NULL, 20, 0, 1210, NULL, true);
INSERT INTO public."BICICLETA" VALUES (417, 'repeating-linear-gradient(45deg, #1DB528 0% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1211, NULL, true);
INSERT INTO public."BICICLETA" VALUES (418, 'repeating-linear-gradient(45deg, #A1C389 0% 33.333333333333%, #9F06C2 33.333333333333% 66.666666666667%, #C3D11D 66.666666666667% 100%)', 6, 'Caloi', NULL, 20, 0, 1212, NULL, true);
INSERT INTO public."BICICLETA" VALUES (419, 'repeating-linear-gradient(45deg, #96F081 0% 50%, #C0A9EE 50% 100%)', 2, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1213, NULL, true);
INSERT INTO public."BICICLETA" VALUES (420, 'repeating-linear-gradient(45deg, #375A7D 0% 100%)', 4, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1214, NULL, true);
INSERT INTO public."BICICLETA" VALUES (422, 'repeating-linear-gradient(45deg, #931554 0% 50%, #C7BA40 50% 100%)', 8, 'Caloi', NULL, 20, 0, 1216, NULL, true);
INSERT INTO public."BICICLETA" VALUES (423, 'repeating-linear-gradient(45deg, #914533 0% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1217, NULL, true);
INSERT INTO public."BICICLETA" VALUES (424, 'repeating-linear-gradient(45deg, #B20932 0% 50%, #27981A 50% 100%)', 2, 'Shimano', NULL, 20, 0, 1218, NULL, true);
INSERT INTO public."BICICLETA" VALUES (425, 'repeating-linear-gradient(45deg, #36158F 0% 33.333333333333%, #474080 33.333333333333% 66.666666666667%, #5A705F 66.666666666667% 100%)', 7, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1219, NULL, true);
INSERT INTO public."BICICLETA" VALUES (426, 'repeating-linear-gradient(45deg, #57B471 0% 50%, #030F89 50% 100%)', 7, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1220, NULL, true);
INSERT INTO public."BICICLETA" VALUES (427, 'repeating-linear-gradient(45deg, #90595B 0% 50%, #10E1F1 50% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1221, NULL, true);
INSERT INTO public."BICICLETA" VALUES (428, 'repeating-linear-gradient(45deg, #E4FA32 0% 100%)', 8, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1222, NULL, true);
INSERT INTO public."BICICLETA" VALUES (429, 'repeating-linear-gradient(45deg, #D2F316 0% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1223, NULL, true);
INSERT INTO public."BICICLETA" VALUES (430, 'repeating-linear-gradient(45deg, #8319B2 0% 33.333333333333%, #48ABE8 33.333333333333% 66.666666666667%, #6A964B 66.666666666667% 100%)', 3, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1224, NULL, true);
INSERT INTO public."BICICLETA" VALUES (431, 'repeating-linear-gradient(45deg, #F29F82 0% 50%, #EC1C32 50% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1225, NULL, true);
INSERT INTO public."BICICLETA" VALUES (432, 'repeating-linear-gradient(45deg, #33610E 0% 50%, #BD315F 50% 100%)', 6, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1226, NULL, true);
INSERT INTO public."BICICLETA" VALUES (433, 'repeating-linear-gradient(45deg, #AF0956 0% 100%)', 3, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1227, NULL, true);
INSERT INTO public."BICICLETA" VALUES (434, 'repeating-linear-gradient(45deg, #566E60 0% 33.333333333333%, #ABDEBB 33.333333333333% 66.666666666667%, #5D6602 66.666666666667% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1228, NULL, true);
INSERT INTO public."BICICLETA" VALUES (435, 'repeating-linear-gradient(45deg, #4B49F8 0% 50%, #635137 50% 100%)', 5, 'Scott', NULL, 20, 0, 1229, NULL, true);
INSERT INTO public."BICICLETA" VALUES (436, 'repeating-linear-gradient(45deg, #A93542 0% 33.333333333333%, #87D0A0 33.333333333333% 66.666666666667%, #C99A62 66.666666666667% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1230, NULL, true);
INSERT INTO public."BICICLETA" VALUES (437, 'repeating-linear-gradient(45deg, #31E497 0% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1231, NULL, true);
INSERT INTO public."BICICLETA" VALUES (438, 'repeating-linear-gradient(45deg, #D80934 0% 33.333333333333%, #5AC649 33.333333333333% 66.666666666667%, #0FB42C 66.666666666667% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1232, NULL, true);
INSERT INTO public."BICICLETA" VALUES (439, 'repeating-linear-gradient(45deg, #29B93C 0% 33.333333333333%, #0294C0 33.333333333333% 66.666666666667%, #519DFC 66.666666666667% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1233, NULL, true);
INSERT INTO public."BICICLETA" VALUES (440, 'repeating-linear-gradient(45deg, #A8D215 0% 33.333333333333%, #A50059 33.333333333333% 66.666666666667%, #BCEA78 66.666666666667% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1234, NULL, true);
INSERT INTO public."BICICLETA" VALUES (442, 'repeating-linear-gradient(45deg, #1C853C 0% 100%)', 8, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1236, NULL, true);
INSERT INTO public."BICICLETA" VALUES (443, 'repeating-linear-gradient(45deg, #1F0784 0% 100%)', 6, 'Scott', NULL, 20, 0, 1237, NULL, true);
INSERT INTO public."BICICLETA" VALUES (445, 'repeating-linear-gradient(45deg, #B264F9 0% 33.333333333333%, #A639B8 33.333333333333% 66.666666666667%, #84E4C4 66.666666666667% 100%)', 6, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1239, NULL, true);
INSERT INTO public."BICICLETA" VALUES (447, 'repeating-linear-gradient(45deg, #ABCEF4 0% 33.333333333333%, #94AD3E 33.333333333333% 66.666666666667%, #7ED7E3 66.666666666667% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1241, NULL, true);
INSERT INTO public."BICICLETA" VALUES (448, 'repeating-linear-gradient(45deg, #096954 0% 33.333333333333%, #C97FA8 33.333333333333% 66.666666666667%, #32BA1F 66.666666666667% 100%)', 4, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1242, NULL, true);
INSERT INTO public."BICICLETA" VALUES (449, 'repeating-linear-gradient(45deg, #BA5E56 0% 100%)', 8, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1243, NULL, true);
INSERT INTO public."BICICLETA" VALUES (450, 'repeating-linear-gradient(45deg, #59FB16 0% 33.333333333333%, #3BD356 33.333333333333% 66.666666666667%, #C75C2D 66.666666666667% 100%)', 3, 'Scott', NULL, 20, 0, 1244, NULL, true);
INSERT INTO public."BICICLETA" VALUES (451, 'repeating-linear-gradient(45deg, #9F79F1 0% 33.333333333333%, #74757C 33.333333333333% 66.666666666667%, #04BB0F 66.666666666667% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1245, NULL, true);
INSERT INTO public."BICICLETA" VALUES (452, 'repeating-linear-gradient(45deg, #8E670F 0% 100%)', 3, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1246, NULL, true);
INSERT INTO public."BICICLETA" VALUES (453, 'repeating-linear-gradient(45deg, #7867A5 0% 33.333333333333%, #FE6A45 33.333333333333% 66.666666666667%, #E6248F 66.666666666667% 100%)', 6, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1247, NULL, true);
INSERT INTO public."BICICLETA" VALUES (454, 'repeating-linear-gradient(45deg, #0F5B8E 0% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1248, NULL, true);
INSERT INTO public."BICICLETA" VALUES (455, 'repeating-linear-gradient(45deg, #618F3C 0% 50%, #A8C1B5 50% 100%)', 5, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1249, NULL, true);
INSERT INTO public."BICICLETA" VALUES (456, 'repeating-linear-gradient(45deg, #934796 0% 50%, #B106DF 50% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1250, NULL, true);
INSERT INTO public."BICICLETA" VALUES (457, 'repeating-linear-gradient(45deg, #8F97FD 0% 33.333333333333%, #2159C5 33.333333333333% 66.666666666667%, #B4EE60 66.666666666667% 100%)', 1, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1251, NULL, true);
INSERT INTO public."BICICLETA" VALUES (458, 'repeating-linear-gradient(45deg, #FC8859 0% 33.333333333333%, #68E123 33.333333333333% 66.666666666667%, #36CD38 66.666666666667% 100%)', 1, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1252, NULL, true);
INSERT INTO public."BICICLETA" VALUES (459, 'repeating-linear-gradient(45deg, #6F2B26 0% 100%)', 8, 'Scott', NULL, 20, 0, 1253, NULL, true);
INSERT INTO public."BICICLETA" VALUES (460, 'repeating-linear-gradient(45deg, #A7DF64 0% 33.333333333333%, #B0EC7B 33.333333333333% 66.666666666667%, #4BFEEE 66.666666666667% 100%)', 5, 'Scott', NULL, 20, 0, 1254, NULL, true);
INSERT INTO public."BICICLETA" VALUES (461, 'repeating-linear-gradient(45deg, #296CAD 0% 33.333333333333%, #F53D93 33.333333333333% 66.666666666667%, #849AA8 66.666666666667% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1255, NULL, true);
INSERT INTO public."BICICLETA" VALUES (462, 'repeating-linear-gradient(45deg, #1AA94D 0% 33.333333333333%, #93513D 33.333333333333% 66.666666666667%, #A93904 66.666666666667% 100%)', 1, NULL, NULL, 20, 0, 1256, NULL, true);
INSERT INTO public."BICICLETA" VALUES (463, 'repeating-linear-gradient(45deg, #D1045D 0% 100%)', 5, 'Caloi', NULL, 20, 0, 1257, NULL, true);
INSERT INTO public."BICICLETA" VALUES (464, 'repeating-linear-gradient(45deg, #3FB40C 0% 50%, #45103B 50% 100%)', 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1258, NULL, true);
INSERT INTO public."BICICLETA" VALUES (465, 'repeating-linear-gradient(45deg, #B1994E 0% 100%)', 2, 'Scott', NULL, 20, 0, 1259, NULL, true);
INSERT INTO public."BICICLETA" VALUES (466, 'repeating-linear-gradient(45deg, #39B897 0% 50%, #0CF3BF 50% 100%)', 7, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1260, NULL, true);
INSERT INTO public."BICICLETA" VALUES (467, 'repeating-linear-gradient(45deg, #58443E 0% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1261, NULL, true);
INSERT INTO public."BICICLETA" VALUES (468, 'repeating-linear-gradient(45deg, #69BC16 0% 33.333333333333%, #51F825 33.333333333333% 66.666666666667%, #935C24 66.666666666667% 100%)', 8, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1262, NULL, true);
INSERT INTO public."BICICLETA" VALUES (469, 'repeating-linear-gradient(45deg, #CD3CDD 0% 50%, #9AF2ED 50% 100%)', 8, 'Shimano', NULL, 20, 0, 1263, NULL, true);
INSERT INTO public."BICICLETA" VALUES (470, 'repeating-linear-gradient(45deg, #3CBD28 0% 33.333333333333%, #DE2D14 33.333333333333% 66.666666666667%, #655837 66.666666666667% 100%)', 8, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1264, NULL, true);
INSERT INTO public."BICICLETA" VALUES (471, 'repeating-linear-gradient(45deg, #948D8E 0% 50%, #EF64E4 50% 100%)', 5, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1265, NULL, true);
INSERT INTO public."BICICLETA" VALUES (472, 'repeating-linear-gradient(45deg, #800A2C 0% 100%)', 4, 'Scott', NULL, 20, 0, 1266, NULL, true);
INSERT INTO public."BICICLETA" VALUES (473, 'repeating-linear-gradient(45deg, #0F9C4C 0% 100%)', 6, 'Caloi', NULL, 20, 0, 1267, NULL, true);
INSERT INTO public."BICICLETA" VALUES (474, 'repeating-linear-gradient(45deg, #9D091A 0% 33.333333333333%, #4B5B14 33.333333333333% 66.666666666667%, #6908FD 66.666666666667% 100%)', 2, NULL, NULL, 20, 0, 1268, NULL, true);
INSERT INTO public."BICICLETA" VALUES (475, 'repeating-linear-gradient(45deg, #7D6C5B 0% 33.333333333333%, #2F8DF1 33.333333333333% 66.666666666667%, #7315CB 66.666666666667% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1269, NULL, true);
INSERT INTO public."BICICLETA" VALUES (476, 'repeating-linear-gradient(45deg, #FC1C7B 0% 100%)', 4, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1270, NULL, true);
INSERT INTO public."BICICLETA" VALUES (477, 'repeating-linear-gradient(45deg, #AA0CA8 0% 100%)', 5, NULL, NULL, 20, 0, 1271, NULL, true);
INSERT INTO public."BICICLETA" VALUES (478, 'repeating-linear-gradient(45deg, #DB760A 0% 50%, #3EE262 50% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1272, NULL, true);
INSERT INTO public."BICICLETA" VALUES (557, 'repeating-linear-gradient(45deg, #100DD1 0% 50%, #F3C5AF 50% 100%)', 6, NULL, NULL, 20, 0, 1351, NULL, true);
INSERT INTO public."BICICLETA" VALUES (480, 'repeating-linear-gradient(45deg, #256534 0% 50%, #24168B 50% 100%)', 3, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1274, NULL, true);
INSERT INTO public."BICICLETA" VALUES (482, 'repeating-linear-gradient(45deg, #6E239C 0% 100%)', 2, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1276, NULL, true);
INSERT INTO public."BICICLETA" VALUES (483, 'repeating-linear-gradient(45deg, #2F14F0 0% 100%)', 1, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1277, NULL, true);
INSERT INTO public."BICICLETA" VALUES (484, 'repeating-linear-gradient(45deg, #927EBD 0% 33.333333333333%, #8DD813 33.333333333333% 66.666666666667%, #0900A0 66.666666666667% 100%)', 6, 'Shimano', NULL, 20, 0, 1278, NULL, true);
INSERT INTO public."BICICLETA" VALUES (485, 'repeating-linear-gradient(45deg, #AB5B6C 0% 100%)', 2, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1279, NULL, true);
INSERT INTO public."BICICLETA" VALUES (486, 'repeating-linear-gradient(45deg, #8B7B63 0% 33.333333333333%, #32C782 33.333333333333% 66.666666666667%, #A5D467 66.666666666667% 100%)', 8, 'Scott', NULL, 20, 0, 1280, NULL, true);
INSERT INTO public."BICICLETA" VALUES (487, 'repeating-linear-gradient(45deg, #5CCD64 0% 50%, #F303B1 50% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1281, NULL, true);
INSERT INTO public."BICICLETA" VALUES (488, 'repeating-linear-gradient(45deg, #55A0BF 0% 33.333333333333%, #99D9A2 33.333333333333% 66.666666666667%, #C5EE1E 66.666666666667% 100%)', 5, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1282, NULL, true);
INSERT INTO public."BICICLETA" VALUES (489, 'repeating-linear-gradient(45deg, #7BD582 0% 100%)', 2, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1283, NULL, true);
INSERT INTO public."BICICLETA" VALUES (490, 'repeating-linear-gradient(45deg, #8998FE 0% 100%)', 8, 'Scott', NULL, 20, 0, 1284, NULL, true);
INSERT INTO public."BICICLETA" VALUES (492, 'repeating-linear-gradient(45deg, #0B627B 0% 33.333333333333%, #5CB366 33.333333333333% 66.666666666667%, #07DE94 66.666666666667% 100%)', 4, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1286, NULL, true);
INSERT INTO public."BICICLETA" VALUES (494, 'repeating-linear-gradient(45deg, #699C2D 0% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1288, NULL, true);
INSERT INTO public."BICICLETA" VALUES (495, 'repeating-linear-gradient(45deg, #B11473 0% 33.333333333333%, #B095E8 33.333333333333% 66.666666666667%, #603791 66.666666666667% 100%)', 5, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1289, NULL, true);
INSERT INTO public."BICICLETA" VALUES (496, 'repeating-linear-gradient(45deg, #CCF8E2 0% 50%, #EDA188 50% 100%)', 7, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1290, NULL, true);
INSERT INTO public."BICICLETA" VALUES (497, 'repeating-linear-gradient(45deg, #65D4CC 0% 33.333333333333%, #67E3C6 33.333333333333% 66.666666666667%, #83EFEF 66.666666666667% 100%)', 2, 'Caloi', NULL, 20, 0, 1291, NULL, true);
INSERT INTO public."BICICLETA" VALUES (498, 'repeating-linear-gradient(45deg, #668A39 0% 50%, #94A914 50% 100%)', 8, NULL, NULL, 20, 0, 1292, NULL, true);
INSERT INTO public."BICICLETA" VALUES (499, 'repeating-linear-gradient(45deg, #ACE9D2 0% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1293, NULL, true);
INSERT INTO public."BICICLETA" VALUES (500, 'repeating-linear-gradient(45deg, #498167 0% 50%, #196490 50% 100%)', 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1294, NULL, true);
INSERT INTO public."BICICLETA" VALUES (502, 'repeating-linear-gradient(45deg, #411851 0% 33.333333333333%, #5CCE30 33.333333333333% 66.666666666667%, #7AEFD8 66.666666666667% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1296, NULL, true);
INSERT INTO public."BICICLETA" VALUES (503, 'repeating-linear-gradient(45deg, #E4A900 0% 50%, #42BCB2 50% 100%)', 3, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1297, NULL, true);
INSERT INTO public."BICICLETA" VALUES (504, 'repeating-linear-gradient(45deg, #981B42 0% 100%)', 3, 'Caloi', NULL, 20, 0, 1298, NULL, true);
INSERT INTO public."BICICLETA" VALUES (505, 'repeating-linear-gradient(45deg, #1A7926 0% 50%, #773E05 50% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1299, NULL, true);
INSERT INTO public."BICICLETA" VALUES (506, 'repeating-linear-gradient(45deg, #667BA3 0% 50%, #0385A7 50% 100%)', 5, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1300, NULL, true);
INSERT INTO public."BICICLETA" VALUES (507, 'repeating-linear-gradient(45deg, #B230D8 0% 33.333333333333%, #B8F056 33.333333333333% 66.666666666667%, #F4A641 66.666666666667% 100%)', 5, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1301, NULL, true);
INSERT INTO public."BICICLETA" VALUES (508, 'repeating-linear-gradient(45deg, #9D7946 0% 50%, #E37ACF 50% 100%)', 5, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1302, NULL, true);
INSERT INTO public."BICICLETA" VALUES (509, 'repeating-linear-gradient(45deg, #EFF31D 0% 50%, #F887A0 50% 100%)', 5, 'Scott', NULL, 20, 0, 1303, NULL, true);
INSERT INTO public."BICICLETA" VALUES (510, 'repeating-linear-gradient(45deg, #2A8E99 0% 33.333333333333%, #F8BBC2 33.333333333333% 66.666666666667%, #85ECC6 66.666666666667% 100%)', 7, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1304, NULL, true);
INSERT INTO public."BICICLETA" VALUES (511, 'repeating-linear-gradient(45deg, #C5FB75 0% 33.333333333333%, #635D86 33.333333333333% 66.666666666667%, #1575B6 66.666666666667% 100%)', 2, 'Shimano', NULL, 20, 0, 1305, NULL, true);
INSERT INTO public."BICICLETA" VALUES (512, 'repeating-linear-gradient(45deg, #F9A01B 0% 100%)', 3, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1306, NULL, true);
INSERT INTO public."BICICLETA" VALUES (513, 'repeating-linear-gradient(45deg, #AA3D18 0% 33.333333333333%, #AFE7D8 33.333333333333% 66.666666666667%, #DD8A9C 66.666666666667% 100%)', 1, 'Caloi', NULL, 20, 0, 1307, NULL, true);
INSERT INTO public."BICICLETA" VALUES (514, 'repeating-linear-gradient(45deg, #61E798 0% 100%)', 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1308, NULL, true);
INSERT INTO public."BICICLETA" VALUES (515, 'repeating-linear-gradient(45deg, #BC78A9 0% 50%, #636637 50% 100%)', 4, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1309, NULL, true);
INSERT INTO public."BICICLETA" VALUES (516, 'repeating-linear-gradient(45deg, #21709B 0% 50%, #6E9000 50% 100%)', 3, NULL, NULL, 20, 0, 1310, NULL, true);
INSERT INTO public."BICICLETA" VALUES (517, 'repeating-linear-gradient(45deg, #262D72 0% 50%, #162A1E 50% 100%)', 6, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1311, NULL, true);
INSERT INTO public."BICICLETA" VALUES (518, 'repeating-linear-gradient(45deg, #B348D1 0% 100%)', 4, 'Caloi', NULL, 20, 0, 1312, NULL, true);
INSERT INTO public."BICICLETA" VALUES (520, 'repeating-linear-gradient(45deg, #C3037D 0% 50%, #04FB3B 50% 100%)', 6, 'Scott', NULL, 20, 0, 1314, NULL, true);
INSERT INTO public."BICICLETA" VALUES (521, 'repeating-linear-gradient(45deg, #CBC52C 0% 50%, #FFB290 50% 100%)', 2, 'Shimano', NULL, 20, 0, 1315, NULL, true);
INSERT INTO public."BICICLETA" VALUES (522, 'repeating-linear-gradient(45deg, #49F48D 0% 50%, #84C8D9 50% 100%)', 4, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1316, NULL, true);
INSERT INTO public."BICICLETA" VALUES (523, 'repeating-linear-gradient(45deg, #9FC2FD 0% 50%, #9CC476 50% 100%)', 2, 'Shimano', NULL, 20, 0, 1317, NULL, true);
INSERT INTO public."BICICLETA" VALUES (524, 'repeating-linear-gradient(45deg, #8DC2A1 0% 33.333333333333%, #66A798 33.333333333333% 66.666666666667%, #6A428F 66.666666666667% 100%)', 1, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1318, NULL, true);
INSERT INTO public."BICICLETA" VALUES (526, 'repeating-linear-gradient(45deg, #F620B2 0% 50%, #0CEE9B 50% 100%)', 6, NULL, NULL, 20, 0, 1320, NULL, true);
INSERT INTO public."BICICLETA" VALUES (527, 'repeating-linear-gradient(45deg, #731E8C 0% 33.333333333333%, #58A798 33.333333333333% 66.666666666667%, #EA5FBF 66.666666666667% 100%)', 2, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1321, NULL, true);
INSERT INTO public."BICICLETA" VALUES (528, 'repeating-linear-gradient(45deg, #355EC1 0% 100%)', 7, 'Caloi', NULL, 20, 0, 1322, NULL, true);
INSERT INTO public."BICICLETA" VALUES (529, 'repeating-linear-gradient(45deg, #FAFD10 0% 50%, #418437 50% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1323, NULL, true);
INSERT INTO public."BICICLETA" VALUES (530, 'repeating-linear-gradient(45deg, #9BBF77 0% 50%, #D0B456 50% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1324, NULL, true);
INSERT INTO public."BICICLETA" VALUES (531, 'repeating-linear-gradient(45deg, #D66561 0% 50%, #EA1572 50% 100%)', 8, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1325, NULL, true);
INSERT INTO public."BICICLETA" VALUES (533, 'repeating-linear-gradient(45deg, #0CAE37 0% 50%, #56FB12 50% 100%)', 7, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1327, NULL, true);
INSERT INTO public."BICICLETA" VALUES (534, 'repeating-linear-gradient(45deg, #70EAD0 0% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1328, NULL, true);
INSERT INTO public."BICICLETA" VALUES (535, 'repeating-linear-gradient(45deg, #812FE4 0% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1329, NULL, true);
INSERT INTO public."BICICLETA" VALUES (536, 'repeating-linear-gradient(45deg, #22DC44 0% 33.333333333333%, #F3EBCB 33.333333333333% 66.666666666667%, #D0FE50 66.666666666667% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1330, NULL, true);
INSERT INTO public."BICICLETA" VALUES (537, 'repeating-linear-gradient(45deg, #45C419 0% 33.333333333333%, #579099 33.333333333333% 66.666666666667%, #FF002F 66.666666666667% 100%)', 8, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1331, NULL, true);
INSERT INTO public."BICICLETA" VALUES (538, 'repeating-linear-gradient(45deg, #419706 0% 50%, #9914CE 50% 100%)', 7, 'Caloi', NULL, 20, 0, 1332, NULL, true);
INSERT INTO public."BICICLETA" VALUES (539, 'repeating-linear-gradient(45deg, #A198CA 0% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1333, NULL, true);
INSERT INTO public."BICICLETA" VALUES (540, 'repeating-linear-gradient(45deg, #F4868A 0% 100%)', 8, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1334, NULL, true);
INSERT INTO public."BICICLETA" VALUES (541, 'repeating-linear-gradient(45deg, #DD48AD 0% 33.333333333333%, #87B170 33.333333333333% 66.666666666667%, #5148F3 66.666666666667% 100%)', 1, NULL, NULL, 20, 0, 1335, NULL, true);
INSERT INTO public."BICICLETA" VALUES (542, 'repeating-linear-gradient(45deg, #B1AD1E 0% 100%)', 5, 'Shimano', NULL, 20, 0, 1336, NULL, true);
INSERT INTO public."BICICLETA" VALUES (543, 'repeating-linear-gradient(45deg, #D61601 0% 33.333333333333%, #8E7466 33.333333333333% 66.666666666667%, #168521 66.666666666667% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1337, NULL, true);
INSERT INTO public."BICICLETA" VALUES (544, 'repeating-linear-gradient(45deg, #27290A 0% 100%)', 4, NULL, NULL, 20, 0, 1338, NULL, true);
INSERT INTO public."BICICLETA" VALUES (545, 'repeating-linear-gradient(45deg, #B2F8E6 0% 33.333333333333%, #BE9D9A 33.333333333333% 66.666666666667%, #BB542A 66.666666666667% 100%)', 5, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1339, NULL, true);
INSERT INTO public."BICICLETA" VALUES (546, 'repeating-linear-gradient(45deg, #64AFB7 0% 50%, #E99368 50% 100%)', 7, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1340, NULL, true);
INSERT INTO public."BICICLETA" VALUES (547, 'repeating-linear-gradient(45deg, #1CF12C 0% 33.333333333333%, #3C226E 33.333333333333% 66.666666666667%, #EC9DC2 66.666666666667% 100%)', 4, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1341, NULL, true);
INSERT INTO public."BICICLETA" VALUES (548, 'repeating-linear-gradient(45deg, #027FFB 0% 33.333333333333%, #4DB532 33.333333333333% 66.666666666667%, #1AB247 66.666666666667% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1342, NULL, true);
INSERT INTO public."BICICLETA" VALUES (549, 'repeating-linear-gradient(45deg, #685C7C 0% 50%, #F72C71 50% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1343, NULL, true);
INSERT INTO public."BICICLETA" VALUES (550, 'repeating-linear-gradient(45deg, #E928F4 0% 100%)', 4, NULL, NULL, 20, 0, 1344, NULL, true);
INSERT INTO public."BICICLETA" VALUES (551, 'repeating-linear-gradient(45deg, #0C4C56 0% 50%, #949833 50% 100%)', 5, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1345, NULL, true);
INSERT INTO public."BICICLETA" VALUES (552, 'repeating-linear-gradient(45deg, #7C169E 0% 33.333333333333%, #1E6BEC 33.333333333333% 66.666666666667%, #C90679 66.666666666667% 100%)', 2, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1346, NULL, true);
INSERT INTO public."BICICLETA" VALUES (553, 'repeating-linear-gradient(45deg, #151896 0% 100%)', 2, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1347, NULL, true);
INSERT INTO public."BICICLETA" VALUES (554, 'repeating-linear-gradient(45deg, #C52BB1 0% 100%)', 4, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1348, NULL, true);
INSERT INTO public."BICICLETA" VALUES (555, 'repeating-linear-gradient(45deg, #2D2FD3 0% 50%, #FD97E8 50% 100%)', 1, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1349, NULL, true);
INSERT INTO public."BICICLETA" VALUES (556, 'repeating-linear-gradient(45deg, #AF829E 0% 100%)', 6, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1350, NULL, true);
INSERT INTO public."BICICLETA" VALUES (559, 'repeating-linear-gradient(45deg, #D84825 0% 50%, #397AD4 50% 100%)', 8, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1353, NULL, true);
INSERT INTO public."BICICLETA" VALUES (560, 'repeating-linear-gradient(45deg, #3CF26E 0% 33.333333333333%, #026DBE 33.333333333333% 66.666666666667%, #C5B7BE 66.666666666667% 100%)', 1, 'Caloi', NULL, 20, 0, 1354, NULL, true);
INSERT INTO public."BICICLETA" VALUES (561, 'repeating-linear-gradient(45deg, #35FDF2 0% 33.333333333333%, #2BFBF0 33.333333333333% 66.666666666667%, #265A1A 66.666666666667% 100%)', 2, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1355, NULL, true);
INSERT INTO public."BICICLETA" VALUES (562, 'repeating-linear-gradient(45deg, #CDC96E 0% 33.333333333333%, #018357 33.333333333333% 66.666666666667%, #BF9F5F 66.666666666667% 100%)', 3, 'Caloi', NULL, 20, 0, 1356, NULL, true);
INSERT INTO public."BICICLETA" VALUES (563, 'repeating-linear-gradient(45deg, #F34033 0% 100%)', 2, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1357, NULL, true);
INSERT INTO public."BICICLETA" VALUES (564, 'repeating-linear-gradient(45deg, #DD43BF 0% 33.333333333333%, #E7B1BC 33.333333333333% 66.666666666667%, #E12A56 66.666666666667% 100%)', 3, NULL, NULL, 20, 0, 1358, NULL, true);
INSERT INTO public."BICICLETA" VALUES (565, 'repeating-linear-gradient(45deg, #1246C0 0% 50%, #096D7E 50% 100%)', 6, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1359, NULL, true);
INSERT INTO public."BICICLETA" VALUES (566, 'repeating-linear-gradient(45deg, #EE032B 0% 33.333333333333%, #97952C 33.333333333333% 66.666666666667%, #6D8859 66.666666666667% 100%)', 8, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1360, NULL, true);
INSERT INTO public."BICICLETA" VALUES (567, 'repeating-linear-gradient(45deg, #BB9D51 0% 33.333333333333%, #783BCD 33.333333333333% 66.666666666667%, #37E8E4 66.666666666667% 100%)', 4, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1361, NULL, true);
INSERT INTO public."BICICLETA" VALUES (568, 'repeating-linear-gradient(45deg, #9A5ADA 0% 50%, #5EDDDB 50% 100%)', 8, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1362, NULL, true);
INSERT INTO public."BICICLETA" VALUES (569, 'repeating-linear-gradient(45deg, #6C8F47 0% 33.333333333333%, #31B770 33.333333333333% 66.666666666667%, #67F00A 66.666666666667% 100%)', 7, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1363, NULL, true);
INSERT INTO public."BICICLETA" VALUES (570, 'repeating-linear-gradient(45deg, #368325 0% 50%, #93F154 50% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1364, NULL, true);
INSERT INTO public."BICICLETA" VALUES (571, 'repeating-linear-gradient(45deg, #BEFA33 0% 50%, #5EE8CB 50% 100%)', 7, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1365, NULL, true);
INSERT INTO public."BICICLETA" VALUES (572, 'repeating-linear-gradient(45deg, #10BF2B 0% 100%)', 4, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1366, NULL, true);
INSERT INTO public."BICICLETA" VALUES (573, 'repeating-linear-gradient(45deg, #EA343A 0% 33.333333333333%, #ED4E7D 33.333333333333% 66.666666666667%, #F8F76D 66.666666666667% 100%)', 8, 'Shimano', NULL, 20, 0, 1367, NULL, true);
INSERT INTO public."BICICLETA" VALUES (574, 'repeating-linear-gradient(45deg, #B88A23 0% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1368, NULL, true);
INSERT INTO public."BICICLETA" VALUES (575, 'repeating-linear-gradient(45deg, #AF4716 0% 50%, #14ADA5 50% 100%)', 4, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1369, NULL, true);
INSERT INTO public."BICICLETA" VALUES (576, 'repeating-linear-gradient(45deg, #1FACEB 0% 50%, #7155E6 50% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet.', 20, 0, 1370, NULL, true);
INSERT INTO public."BICICLETA" VALUES (577, 'repeating-linear-gradient(45deg, #6EB6EB 0% 33.333333333333%, #E3B98B 33.333333333333% 66.666666666667%, #3493BC 66.666666666667% 100%)', 2, 'Shimano', NULL, 20, 0, 1371, NULL, true);
INSERT INTO public."BICICLETA" VALUES (578, 'repeating-linear-gradient(45deg, #376868 0% 33.333333333333%, #0FD766 33.333333333333% 66.666666666667%, #FBC6FE 66.666666666667% 100%)', 4, 'Scott', NULL, 20, 0, 1372, NULL, true);
INSERT INTO public."BICICLETA" VALUES (579, 'repeating-linear-gradient(45deg, #5170A9 0% 50%, #0E4BA1 50% 100%)', 7, 'Caloi', NULL, 20, 0, 1373, NULL, true);
INSERT INTO public."BICICLETA" VALUES (580, 'repeating-linear-gradient(45deg, #27EABD 0% 100%)', 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1374, NULL, true);
INSERT INTO public."BICICLETA" VALUES (581, 'repeating-linear-gradient(45deg, #67A48F 0% 100%)', 4, 'Shimano', NULL, 20, 0, 1375, NULL, true);
INSERT INTO public."BICICLETA" VALUES (582, 'repeating-linear-gradient(45deg, #B84792 0% 50%, #043F9D 50% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1376, NULL, true);
INSERT INTO public."BICICLETA" VALUES (583, 'repeating-linear-gradient(45deg, #1A09D4 0% 100%)', 4, 'Shimano', NULL, 20, 0, 1377, NULL, true);
INSERT INTO public."BICICLETA" VALUES (584, 'repeating-linear-gradient(45deg, #17671E 0% 50%, #D2BAF5 50% 100%)', 6, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1378, NULL, true);
INSERT INTO public."BICICLETA" VALUES (585, 'repeating-linear-gradient(45deg, #5992B4 0% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1379, NULL, true);
INSERT INTO public."BICICLETA" VALUES (587, 'repeating-linear-gradient(45deg, #2D886C 0% 33.333333333333%, #2BDA22 33.333333333333% 66.666666666667%, #B9C729 66.666666666667% 100%)', 6, 'Scott', NULL, 20, 0, 1381, NULL, true);
INSERT INTO public."BICICLETA" VALUES (589, 'repeating-linear-gradient(45deg, #FF6768 0% 33.333333333333%, #1E432E 33.333333333333% 66.666666666667%, #AD1AB9 66.666666666667% 100%)', 7, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1383, NULL, true);
INSERT INTO public."BICICLETA" VALUES (590, 'repeating-linear-gradient(45deg, #782983 0% 100%)', 3, 'Scott', 'Lorem ipsum dolor sit amet.', 20, 0, 1384, NULL, true);
INSERT INTO public."BICICLETA" VALUES (591, 'repeating-linear-gradient(45deg, #293563 0% 33.333333333333%, #DA2F70 33.333333333333% 66.666666666667%, #390002 66.666666666667% 100%)', 7, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1385, NULL, true);
INSERT INTO public."BICICLETA" VALUES (592, 'repeating-linear-gradient(45deg, #9F53D4 0% 33.333333333333%, #9D7C87 33.333333333333% 66.666666666667%, #DE6323 66.666666666667% 100%)', 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1386, NULL, true);
INSERT INTO public."BICICLETA" VALUES (593, 'repeating-linear-gradient(45deg, #48670F 0% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1387, NULL, true);
INSERT INTO public."BICICLETA" VALUES (407, 'repeating-linear-gradient(45deg, #DC2152 0% 50%, #561CA7 50% 100%)', 2, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1201, NULL, true);
INSERT INTO public."BICICLETA" VALUES (421, 'repeating-linear-gradient(45deg, #5A8987 0% 33.333333333333%, #D6177D 33.333333333333% 66.666666666667%, #4CC8DD 66.666666666667% 100%)', 7, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1215, NULL, true);
INSERT INTO public."BICICLETA" VALUES (441, 'repeating-linear-gradient(45deg, #001B02 0% 100%)', 7, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1235, NULL, true);
INSERT INTO public."BICICLETA" VALUES (444, 'repeating-linear-gradient(45deg, #3EDA0D 0% 100%)', 5, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1238, NULL, true);
INSERT INTO public."BICICLETA" VALUES (479, 'repeating-linear-gradient(45deg, #B985E4 0% 33.333333333333%, #47EE9F 33.333333333333% 66.666666666667%, #4BFAA2 66.666666666667% 100%)', 4, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1273, NULL, true);
INSERT INTO public."BICICLETA" VALUES (501, 'repeating-linear-gradient(45deg, #C14FCB 0% 33.333333333333%, #A38EAE 33.333333333333% 66.666666666667%, #517FBD 66.666666666667% 100%)', 6, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1295, NULL, true);
INSERT INTO public."BICICLETA" VALUES (519, 'repeating-linear-gradient(45deg, #112BD2 0% 33.333333333333%, #8C53F0 33.333333333333% 66.666666666667%, #B74672 66.666666666667% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1313, NULL, true);
INSERT INTO public."BICICLETA" VALUES (532, 'repeating-linear-gradient(45deg, #71DA11 0% 33.333333333333%, #4664E0 33.333333333333% 66.666666666667%, #0796D4 66.666666666667% 100%)', 2, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1326, NULL, true);
INSERT INTO public."BICICLETA" VALUES (558, 'repeating-linear-gradient(45deg, #E19A82 0% 33.333333333333%, #B51B40 33.333333333333% 66.666666666667%, #075794 66.666666666667% 100%)', 4, 'Shimano', NULL, 20, 0, 1352, NULL, true);
INSERT INTO public."BICICLETA" VALUES (586, 'repeating-linear-gradient(45deg, #294CE2 0% 33.333333333333%, #C66664 33.333333333333% 66.666666666667%, #84D908 66.666666666667% 100%)', 3, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1380, NULL, true);
INSERT INTO public."BICICLETA" VALUES (594, 'repeating-linear-gradient(45deg, #E1E73D 0% 33.333333333333%, #CBCCC2 33.333333333333% 66.666666666667%, #26E9DF 66.666666666667% 100%)', 4, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1388, NULL, true);
INSERT INTO public."BICICLETA" VALUES (595, 'repeating-linear-gradient(45deg, #E29FA6 0% 33.333333333333%, #CDCA8E 33.333333333333% 66.666666666667%, #ACD721 66.666666666667% 100%)', 4, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1389, NULL, true);
INSERT INTO public."BICICLETA" VALUES (596, 'repeating-linear-gradient(45deg, #002577 0% 33.333333333333%, #ACF1BF 33.333333333333% 66.666666666667%, #D0791F 66.666666666667% 100%)', 1, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1390, NULL, true);
INSERT INTO public."BICICLETA" VALUES (597, 'repeating-linear-gradient(45deg, #3F9C98 0% 50%, #A63DED 50% 100%)', 4, 'Caloi', NULL, 20, 0, 1391, NULL, true);
INSERT INTO public."BICICLETA" VALUES (598, 'repeating-linear-gradient(45deg, #243927 0% 50%, #EB65FE 50% 100%)', 1, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1392, NULL, true);
INSERT INTO public."BICICLETA" VALUES (599, 'repeating-linear-gradient(45deg, #0B2ED0 0% 100%)', 6, 'Shimano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1393, NULL, true);
INSERT INTO public."BICICLETA" VALUES (600, 'repeating-linear-gradient(45deg, #D06872 0% 50%, #0EB265 50% 100%)', 6, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1394, NULL, true);
INSERT INTO public."BICICLETA" VALUES (601, 'repeating-linear-gradient(45deg, #727047 0% 50%, #D9728C 50% 100%)', 4, 'Scott', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1395, NULL, true);
INSERT INTO public."BICICLETA" VALUES (602, 'repeating-linear-gradient(45deg, #47ADDD 0% 100%)', 7, 'Caloi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.', 20, 0, 1396, NULL, true);
INSERT INTO public."BICICLETA" VALUES (603, 'repeating-linear-gradient(45deg, #B5A658 0% 100%)', 3, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1397, NULL, true);
INSERT INTO public."BICICLETA" VALUES (604, 'repeating-linear-gradient(45deg, #94EB39 0% 33.333333333333%, #86B6EB 33.333333333333% 66.666666666667%, #283E44 66.666666666667% 100%)', 5, NULL, 'Lorem ipsum dolor sit amet.', 20, 0, 1398, NULL, true);
INSERT INTO public."BICICLETA" VALUES (605, 'repeating-linear-gradient(45deg, #C211FB 0% 100%)', 4, 'Caloi', 'Lorem ipsum dolor sit amet.', 20, 0, 1399, NULL, true);
INSERT INTO public."BICICLETA" VALUES (606, 'repeating-linear-gradient(45deg, #95AE84 0% 50%, #231E34 50% 100%)', 6, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.', 20, 0, 1400, NULL, true);


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       2927.dat                                                                                            0000600 0004000 0002000 00000000002 13562536246 0014261 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              2921.dat                                                                                            0000600 0004000 0002000 00000000270 13562536246 0014262 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."FUNCIONARIO" VALUES (1, 'Dahan Schuster', 'dan.plschuster@gmail.com', NULL, '077.132.735-81', 0, '$2y$10$NvM5r0/fwgtRez13GDD0QO/gINggndV0dSjeyTlM9OfKyojJ2QvUO');


                                                                                                                                                                                                                                                                                                                                        2925.dat                                                                                            0000600 0004000 0002000 00000002341 13562536246 0014267 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."REGISTRO" VALUES (4, '2019-10-31 11:09:21', '', 1, 2, 1, 3);
INSERT INTO public."REGISTRO" VALUES (3, '2019-10-31 11:09:17', '', 1, 2, 1, 4);
INSERT INTO public."REGISTRO" VALUES (5, '2019-10-31 11:10:53', '', 1, 2, 1, 5);
INSERT INTO public."REGISTRO" VALUES (7, '2019-10-31 11:13:27', '', 1, 2, 1, 6);
INSERT INTO public."REGISTRO" VALUES (6, '2019-10-31 11:13:20', '', 1, 2, 1, 10);
INSERT INTO public."REGISTRO" VALUES (8, '2019-10-31 11:14:16', '', 1, 2, 1, 11);
INSERT INTO public."REGISTRO" VALUES (9, '2019-10-31 12:13:48', '', 0, 2, 1, 12);
INSERT INTO public."REGISTRO" VALUES (10, '2019-10-31 12:14:46', '', 0, 2, 1, 15);
INSERT INTO public."REGISTRO" VALUES (11, '2019-10-31 12:25:43', '', 0, 2, 1, 16);
INSERT INTO public."REGISTRO" VALUES (13, '2019-10-31 12:28:37', '', 0, 2, 1, 17);
INSERT INTO public."REGISTRO" VALUES (12, '2019-10-31 12:28:24', '', 0, 2, 1, 18);
INSERT INTO public."REGISTRO" VALUES (14, '2019-10-31 12:58:10', '', 0, 2, 1, 19);
INSERT INTO public."REGISTRO" VALUES (15, '2019-10-31 17:18:26', '', 0, 2, 1, 20);
INSERT INTO public."REGISTRO" VALUES (16, '2019-10-31 18:07:47', 'Tudo de bom', 5, 2, 1, 21);
INSERT INTO public."REGISTRO" VALUES (17, '2019-10-31 18:09:36', '', 0, 2, 1, NULL);


                                                                                                                                                                                                                                                                                               2930.dat                                                                                            0000600 0004000 0002000 00000000121 13562536246 0014255 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."REQUISICAO" VALUES (true, '2019-11-06 05:45:04', 2, 1, 4);


                                                                                                                                                                                                                                                                                                                                                                                                                                               2923.dat                                                                                            0000600 0004000 0002000 00000002174 13562536246 0014271 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."SAIDA" VALUES (1, '2019-10-31 17:09:41', '', 1);
INSERT INTO public."SAIDA" VALUES (2, '2019-10-31 17:09:50', '', 1);
INSERT INTO public."SAIDA" VALUES (3, '2019-10-31 17:10:21', '', 1);
INSERT INTO public."SAIDA" VALUES (4, '2019-10-31 17:12:32', '', 1);
INSERT INTO public."SAIDA" VALUES (5, '2019-10-31 17:12:51', '', 1);
INSERT INTO public."SAIDA" VALUES (6, '2019-10-31 17:13:19', '', 1);
INSERT INTO public."SAIDA" VALUES (10, '2019-10-31 17:17:40', '', 1);
INSERT INTO public."SAIDA" VALUES (11, '2019-10-31 17:17:44', '', 1);
INSERT INTO public."SAIDA" VALUES (12, '2019-10-31 17:17:52', '', 1);
INSERT INTO public."SAIDA" VALUES (15, '2019-10-31 17:18:09', '', 1);
INSERT INTO public."SAIDA" VALUES (16, '2019-10-31 17:18:11', '', 1);
INSERT INTO public."SAIDA" VALUES (17, '2019-10-31 17:18:13', '', 1);
INSERT INTO public."SAIDA" VALUES (18, '2019-10-31 17:18:16', '', 1);
INSERT INTO public."SAIDA" VALUES (19, '2019-10-31 17:18:19', '', 1);
INSERT INTO public."SAIDA" VALUES (20, '2019-10-31 17:18:28', '', 1);
INSERT INTO public."SAIDA" VALUES (21, '2019-10-31 18:08:58', 'foi tudo ok, graças a Jah(Deus)', 1);


                                                                                                                                                                                                                                                                                                                                                                                                    2919.dat                                                                                            0000600 0004000 0002000 00000005025 13562536246 0014274 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."TagRFID" VALUES (1, '21 32 13 12', 2);
INSERT INTO public."TagRFID" VALUES (116, '4C2B26F4', 415);
INSERT INTO public."TagRFID" VALUES (117, '0E5BB448', 418);
INSERT INTO public."TagRFID" VALUES (118, '8A2BED0F', 421);
INSERT INTO public."TagRFID" VALUES (119, '12B58A8C', 427);
INSERT INTO public."TagRFID" VALUES (120, '42D7B182', 430);
INSERT INTO public."TagRFID" VALUES (121, '5C12E471', 439);
INSERT INTO public."TagRFID" VALUES (122, '3057B738', 445);
INSERT INTO public."TagRFID" VALUES (123, 'BC622150', 448);
INSERT INTO public."TagRFID" VALUES (124, '1B91D459', 451);
INSERT INTO public."TagRFID" VALUES (125, 'EABC7AE1', 454);
INSERT INTO public."TagRFID" VALUES (126, '52D0857F', 457);
INSERT INTO public."TagRFID" VALUES (127, '25180250', 460);
INSERT INTO public."TagRFID" VALUES (128, 'AEEF7F72', 466);
INSERT INTO public."TagRFID" VALUES (129, '7A09A707', 469);
INSERT INTO public."TagRFID" VALUES (130, 'A6B0EFA7', 475);
INSERT INTO public."TagRFID" VALUES (132, '4207E445', 484);
INSERT INTO public."TagRFID" VALUES (133, 'B369C206', 490);
INSERT INTO public."TagRFID" VALUES (135, '0B8B0395', 502);
INSERT INTO public."TagRFID" VALUES (136, '487A6B07', 505);
INSERT INTO public."TagRFID" VALUES (137, '7CB986C4', 508);
INSERT INTO public."TagRFID" VALUES (138, '2136F579', 511);
INSERT INTO public."TagRFID" VALUES (139, '9E2D5612', 514);
INSERT INTO public."TagRFID" VALUES (140, '7794956D', 523);
INSERT INTO public."TagRFID" VALUES (141, 'C7779AFB', 529);
INSERT INTO public."TagRFID" VALUES (142, '9445721D', 532);
INSERT INTO public."TagRFID" VALUES (143, '963D41C5', 550);
INSERT INTO public."TagRFID" VALUES (144, '220629EA', 553);
INSERT INTO public."TagRFID" VALUES (145, 'EC9BFB16', 556);
INSERT INTO public."TagRFID" VALUES (146, '0C6DA98F', 559);
INSERT INTO public."TagRFID" VALUES (147, '945F193A', 565);
INSERT INTO public."TagRFID" VALUES (148, 'F080E0F9', 568);
INSERT INTO public."TagRFID" VALUES (149, '9F7D6146', 571);
INSERT INTO public."TagRFID" VALUES (150, '3ADEB160', 574);
INSERT INTO public."TagRFID" VALUES (151, '0E921B58', 577);
INSERT INTO public."TagRFID" VALUES (152, 'D9681333', 583);
INSERT INTO public."TagRFID" VALUES (153, '849FE876', 586);
INSERT INTO public."TagRFID" VALUES (154, 'D45678A4', 589);
INSERT INTO public."TagRFID" VALUES (155, '38AC951F', 592);
INSERT INTO public."TagRFID" VALUES (156, '901374C5', 595);
INSERT INTO public."TagRFID" VALUES (157, 'E59F8672', 598);
INSERT INTO public."TagRFID" VALUES (158, '4ED150E4', 601);
INSERT INTO public."TagRFID" VALUES (159, '46EE41C8', 604);


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2915.dat                                                                                            0000600 0004000 0002000 00000117064 13562536246 0014277 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        INSERT INTO public."USUARIO" VALUES (1227, 'Enrico Eliseev', '(86) 95570-4231', 'enrico@iCloud.com', 2, 0, NULL, '108.318.791-06', false, '$2y$10$Skky8ZmwNd1fCUNlFVLYGeWywTE19tr0RFtApJns.dq1/QyJ4LeNK');
INSERT INTO public."USUARIO" VALUES (1229, 'Grant Moiseev', '(67) 91400-2650', 'grant@outlook.com', 1, 0, '20184585360', '539.660.896-02', false, '$2y$10$PdOyvGoXY9CfrHn1W.du2u2QH1MtSWp0Gy/cRo/GE1KIZYhqVsQ3q');
INSERT INTO public."USUARIO" VALUES (1230, 'Jesse Adamovich', '(93) 93147-6800', 'jesse@iCloud.com', 2, 0, NULL, '280.764.952-10', false, '$2y$10$L87eGEGFgJTkzUD4AMPP7O5actMeIk6K9o8N4QAVjep3zX23zvKMi');
INSERT INTO public."USUARIO" VALUES (1231, 'Leone Zemlin', '(67) 94990-6924', 'leone@gmail.com', 1, 0, '20036405896', '432.404.181-42', false, '$2y$10$dWrunbWnoScKhQhy8LDvuuGeRO10onZQC8br/T6WwCHFb7udqeZsK');
INSERT INTO public."USUARIO" VALUES (1232, 'James Nestorov', '(65) 94301-3113', 'james@yahoo.com', 1, 0, '20173238984', '876.927.754-00', false, '$2y$10$dqkpHpzP/flvsAw3lYkpl.A8oILeoNIUKqtnxWIuLuoyz.LUniaZ6');
INSERT INTO public."USUARIO" VALUES (1233, 'Gary Savich', '(97) 94486-5999', 'gary@gmail.com', 1, 0, '20116215223', '516.963.780-28', false, '$2y$10$d1OGbhPi75c7MVmQ2UTMo.NJTtr6aYWvyIktMhZaq4OjG5K5JsJDu');
INSERT INTO public."USUARIO" VALUES (1236, 'Luke Mamaev', '(93) 99444-6345', 'luke@zoho.com', 2, 0, NULL, '173.335.368-23', false, '$2y$10$VDeIAe37SEE6nEmop0rQou5uCHRN5KM8JeaZv2cgxma4e0sWzrJWW');
INSERT INTO public."USUARIO" VALUES (1237, 'Kiran Dmitriev', '(17) 97793-2871', 'kiran@yahoo.com', 2, 0, NULL, '415.937.552-95', false, '$2y$10$ni1R7RCvfgxWbnfvpgwZOu/NlCz7FpXcZ8Op0hq.oMXIncHFsazuC');
INSERT INTO public."USUARIO" VALUES (1238, 'Harley Khrushchov', '(14) 97358-3028', 'harley@gmail.com', 1, 0, '20159996750', '692.321.086-07', false, '$2y$10$G39H/FEQJeA5O/dSpFsC4OYR70cYRzMPuqcPj5G1aPeleroGhTdPm');
INSERT INTO public."USUARIO" VALUES (1241, 'Stephen Sonin', '(41) 96916-1112', 'stephen@yahoo.com', 1, 0, '2010591302', '225.441.527-10', false, '$2y$10$/dTzyysM/l2cmW64ocdMvu/gCXMhY7VUNxM4DYAoMumeDtvlUtkhW');
INSERT INTO public."USUARIO" VALUES (1242, 'Todd Olenin', '(62) 96009-6730', 'todd@zoho.com', 1, 0, '20094071106', '014.098.415-10', false, '$2y$10$0ehOqw7smhuAbxNn2ywXI.CE5bEQNybK7yLevEskXFBKksy0KzTOC');
INSERT INTO public."USUARIO" VALUES (1, 'Casey Safonov', '(19) 95840-5541', '0', 2, 0, '20073792612', '883.331.085-04', false, '$2y$10$NvM5r0/fwgtRez13GDD0QO/gINggndV0dSjeyTlM9OfKyojJ2QvUO');
INSERT INTO public."USUARIO" VALUES (1201, 'Garner Artemiev', '(84) 95126-4159', 'garner@mail.com', 2, 0, NULL, '717.940.373-30', false, '$2y$10$DSruxTE/dJ7LY4OdZImAA.7NBpx/uByDatgAH9PQWpjPIgKXNjNcW');
INSERT INTO public."USUARIO" VALUES (1202, 'Guillaume Garin', '(88) 91067-5696', 'guillaume@zoho.com', 1, 0, '2007313525', '586.821.779-94', false, '$2y$10$kFTTwZ/7gYkiLeGa2Z8qUO.9ap0LW5g6SxQsEaJeih.sLnveL2lt6');
INSERT INTO public."USUARIO" VALUES (1203, 'Julian Teplov', '(84) 97591-7413', 'julian@outlook.com', 2, 0, NULL, '535.341.771-26', false, '$2y$10$vwv2sFZZsTy2Yum9o3oK/udOLqM/8YR5Fbceu3VJ.kWtRiGq0nvOq');
INSERT INTO public."USUARIO" VALUES (1204, 'Eliah Borodin', '(16) 97158-1068', 'eliah@iCloud.com', 2, 0, NULL, '207.385.658-65', false, '$2y$10$lUekRAmdZf4sku/JfRRcnegn9Gdwdf03pNOR9Sm4Vp9sD5UaxqgG2');
INSERT INTO public."USUARIO" VALUES (1206, 'Kirk Danilov', '(77) 96840-3475', 'kirk@zoho.com', 2, 0, NULL, '158.291.058-88', false, '$2y$10$VvyneIpGqC6thIxj4zpf7uZIuSWGvQYZhlHseRkLmgXzS4SH/WU6a');
INSERT INTO public."USUARIO" VALUES (1207, 'Matti Kireev', '(95) 92258-9897', 'matti@zoho.com', 1, 0, '20065748474', '071.119.133-61', false, '$2y$10$T2Fxm8kiuXehNEoC6IYtAeZxPLdkJcp.i.RAXga6IDPEl5jGETMeG');
INSERT INTO public."USUARIO" VALUES (1213, 'Javier Gerasimov', '(24) 99352-6645', 'javier@gmail.com', 2, 0, NULL, '995.404.941-09', false, '$2y$10$Q3KZkMMCnDNr4kqxpz942OKeZaHtwHkgokREDu8qhbNZ84/qoTC6W');
INSERT INTO public."USUARIO" VALUES (1214, 'Vincent Astakhov', '(89) 97727-6449', 'vincent@zoho.com', 2, 0, NULL, '333.210.805-08', false, '$2y$10$5LwriGhQJae2Fxe.zYLa6us0U9tBX9t386/yJrc15aUlD2N1JsltC');
INSERT INTO public."USUARIO" VALUES (1215, 'Tatum Tretiakov', '(42) 98647-7404', 'tatum@outlook.com', 1, 0, '20005295873', '763.634.254-50', false, '$2y$10$sHLvykWRaeeeml4cr9F4Xu1kZiT4v9QsxCbWigVWiCWo2dX2UNZr2');
INSERT INTO public."USUARIO" VALUES (1217, 'Eliah Safonov', '(13) 95690-2059', 'eliah@zoho.com', 1, 0, '20005652139', '511.496.855-65', false, '$2y$10$RPP2DZCQR7.k0HTorWQZcunvTxti0hwvzwcQuBPl2oSuK5Q5oQpfS');
INSERT INTO public."USUARIO" VALUES (1218, 'Seth Maikov', '(62) 99883-3885', 'seth@zoho.com', 2, 0, NULL, '488.507.823-73', false, '$2y$10$dIg8C64DQzmgwHeMPLRNu.DwILBKSmMSxxMs6m1FBh15wRAztUPnq');
INSERT INTO public."USUARIO" VALUES (1220, 'Joey Alekseev', '(14) 96527-5185', 'joey@mail.com', 2, 0, NULL, '971.549.579-64', false, '$2y$10$L0HJq3jUG.wkNQcXZ3Z7ue3xzEWf1wPw3DTqJlSa.PCIKSc8KPqEW');
INSERT INTO public."USUARIO" VALUES (1223, 'Diesel Denisov', '(53) 95772-8868', 'diesel@zoho.com', 1, 0, '20103791798', '805.262.192-54', false, '$2y$10$pQtcBL8/aIgNud5Qszo3P.K65tFT5EGV0jQ/czYdniBre8PRhHvqS');
INSERT INTO public."USUARIO" VALUES (1224, 'Hanson Ilinsky', '(67) 96045-9061', 'hanson@outlook.com', 1, 0, '20123265953', '073.321.791-56', false, '$2y$10$X4/jw/H/zD/2JsVk3Nd1jOpdekUb4Ks.b5VX7SdSE4CPag4rmQOiG');
INSERT INTO public."USUARIO" VALUES (1225, 'Luka Gladkov', '(32) 93897-9330', 'luka@gmail.com', 1, 0, '20137226420', '091.884.619-63', false, '$2y$10$fw4JNFTdqWM4ljeRwws/VeEw8WGNlDSukvQiDnqnA4berLKo0T2Le');
INSERT INTO public."USUARIO" VALUES (1244, 'Hendrix Mishin', '(45) 91190-7870', 'hendrix@iCloud.com', 2, 0, NULL, '068.980.168-81', false, '$2y$10$pl0iQuW4QlfLaOrolY3zEemjxbvxJPxkyuh8i0rTsxXedevhJNDeq');
INSERT INTO public."USUARIO" VALUES (1246, 'Enzo Mamaev', '(77) 97868-6820', 'enzo@iCloud.com', 2, 0, NULL, '810.250.941-40', false, '$2y$10$hd0tqT/5.AN5OudSH.sH5eMnRhtK5pWxT0ToQlJDbt9gFBru.OpY2');
INSERT INTO public."USUARIO" VALUES (1251, 'Kingsley Gagin', '(75) 93131-5743', 'kingsley@outlook.com', 1, 0, '20162712667', '692.913.200-48', false, '$2y$10$veTqmWCTj5e4JxScTMc1ju53t8cK00GcRuLaZlpxS3KVSD0P0baC.');
INSERT INTO public."USUARIO" VALUES (1254, 'Olin Avdeev', '(93) 93331-1371', 'olin@iCloud.com', 1, 0, '20162285900', '932.739.391-09', false, '$2y$10$mH6Vp4bYGjEF5kfbQzLsXejwpUHfWIsDdnkMIZkgnwG8TKhR72WoK');
INSERT INTO public."USUARIO" VALUES (1255, 'Evert Balakirev', '(32) 92509-6705', 'evert@iCloud.com', 1, 0, '20067854379', '757.296.166-51', false, '$2y$10$KmMwpDXOW1G6HiaIYpD/n.6S.E8mnJc0QjJxmmEj4LcuFOk5V8o3.');
INSERT INTO public."USUARIO" VALUES (1257, 'Luigi Filimonov', '(19) 94786-8592', 'luigi@gmail.com', 2, 0, NULL, '212.806.510-08', false, '$2y$10$Aa8kfudksmGmzUQGayz3IuJ/GLIKmZPCG58tyoCUbG7KYOz61gH1W');
INSERT INTO public."USUARIO" VALUES (1258, 'Samson Titov', '(17) 92471-5122', 'samson@iCloud.com', 1, 0, '20058276007', '123.564.166-09', false, '$2y$10$cBiUbUnQwFjD.YH.wGwBbuFQ6A7ktYeeLiLznuc/nX5TyL1Bn/9EG');
INSERT INTO public."USUARIO" VALUES (1259, 'Duncan Koshelev', '(93) 98200-2246', 'duncan@iCloud.com', 2, 0, NULL, '466.433.231-93', false, '$2y$10$5RQ02k7AKGfaLJTYYBRS2OSO4vLR5D5L9GVVtwVhU.IvrYJzYgk0K');
INSERT INTO public."USUARIO" VALUES (1260, 'Cameron Verigin', '(46) 93157-5251', 'cameron@yahoo.com', 1, 0, '20124233334', '773.356.046-21', false, '$2y$10$zJt6.4XbQYEPBwV3SrGuUeOkrjtipFdlnHlswLBUKfwZfhrqPkLmW');
INSERT INTO public."USUARIO" VALUES (1262, 'Gianluca Ragozin', '(62) 97259-8994', 'gianluca@mail.com', 1, 0, '20095506613', '620.775.819-64', false, '$2y$10$6HIgSEJCDdeX6UdEIj8p7e.Jv5UVK55rQojRYebdCvXvzkQzmSv0S');
INSERT INTO public."USUARIO" VALUES (1264, 'Gaspard Volkov', '(19) 93770-8958', 'gaspard@yahoo.com', 1, 0, '20029392689', '625.037.521-01', false, '$2y$10$jC8nh070PGl2P3nXpP9pdOtP8w7xoWSswkG0wT9vVh32Aq/gM83g2');
INSERT INTO public."USUARIO" VALUES (1265, 'Xander Ermolov', '(69) 93772-5419', 'xander@iCloud.com', 2, 0, NULL, '661.951.172-42', false, '$2y$10$KQd77Ccwg/IXV2yaovB./OPGmzWXCtMitUg7KjQJWYwThfNqXDPI.');
INSERT INTO public."USUARIO" VALUES (1266, 'Joseph Lazarev', '(53) 98038-6261', 'joseph@yahoo.com', 2, 0, NULL, '495.194.744-71', false, '$2y$10$e5cTByJ8A5CCyC8UTP/3d.RtMyBJs5xkt91Hddrz0/XlDf02yddFG');
INSERT INTO public."USUARIO" VALUES (1271, 'Viggo Galagan', '(94) 96591-1393', 'viggo@gmail.com', 1, 0, '20165615046', '592.593.794-58', false, '$2y$10$P549YKrI/9SscBHbeSOmXOcZoRv1a84GPmaaNFcqTzLaLhSNnK8jO');
INSERT INTO public."USUARIO" VALUES (1272, 'Bennett Stolypin', '(63) 92581-2604', 'bennett@yahoo.com', 2, 0, NULL, '665.430.646-50', false, '$2y$10$.NzMUlFcz7Wj0s2FatuYfuG3ftNFWdqzzY057MWFmNnXGWtZeKZwW');
INSERT INTO public."USUARIO" VALUES (1276, 'Murphy Pozniak', '(14) 93283-3587', 'murphy@iCloud.com', 2, 0, NULL, '959.491.229-41', false, '$2y$10$Ww5Ubp17BU2fPm6cV7KcXOL56N65DsHfHQka4.AUQoK4ScsVsLpdG');
INSERT INTO public."USUARIO" VALUES (1277, 'Kingston Muratov', '(43) 91801-3742', 'kingston@yahoo.com', 2, 0, NULL, '373.772.653-10', false, '$2y$10$7922JgP8R00Oj1iZEhMCTOCfRCrdOWDZrtaQ2cgUilFmk6QFHMHWa');
INSERT INTO public."USUARIO" VALUES (1279, 'Hayden Sokolov', '(53) 95006-3117', 'hayden@iCloud.com', 1, 0, '20035655698', '120.652.270-44', false, '$2y$10$Fq5Xr/nz/UZ8NsMkJuB0uORV/CD.fWFMP2Ho0VqyiT3.i9VP80uc.');
INSERT INTO public."USUARIO" VALUES (1281, 'Oliver Alekseev', '(96) 96556-1232', 'oliver@mail.com', 2, 0, NULL, '277.823.412-80', false, '$2y$10$gVluamviny.ApiDDBz0PWO7jgfgtjrpeLNw0yn0Wmyq5d38R/K97C');
INSERT INTO public."USUARIO" VALUES (1284, 'Tracey Mukhanov', '(48) 91119-4673', 'tracey@mail.com', 1, 0, '20162665113', '209.820.594-50', false, '$2y$10$qINCGPaP01FFf7S431JE8OJQSdrjTK3IHn5MLYB9GC53mK4V7tFbi');
INSERT INTO public."USUARIO" VALUES (1286, 'Jeremy Gubarev', '(49) 98744-8269', 'jeremy@zoho.com', 2, 0, NULL, '371.529.351-90', false, '$2y$10$s7BW1dgiduoI6hTWQZyFe.vkNFuWZk4qNjHvufvtSrq0VQHVc6kD.');
INSERT INTO public."USUARIO" VALUES (1289, 'Gavin Samsonov', '(24) 93767-3497', 'gavin@iCloud.com', 1, 0, '20058736750', '763.990.332-76', false, '$2y$10$2KDw1ci7QAHbV/NPfEuebuTWgC8/85uzlvyhOYEdEE5/jYvdLlyy6');
INSERT INTO public."USUARIO" VALUES (1290, 'Ivan Sinitsyn', '(43) 99340-3936', 'ivan@yahoo.com', 2, 0, NULL, '768.193.807-98', false, '$2y$10$vzcvK33DIdQItGjGY6o2N.9XUcaCEdQ8XTBnYf095z2CrHvUzuaiS');
INSERT INTO public."USUARIO" VALUES (1291, 'Tristan Komarov', '(82) 98346-3603', 'tristan@zoho.com', 2, 0, NULL, '066.705.667-00', false, '$2y$10$m3s.rl9ZteVsYni0mnBrp.8qgbvrEtTzh6tLcEWDDLjWtUuSYeKJW');
INSERT INTO public."USUARIO" VALUES (1292, 'Jensen Stepanov', '(69) 99470-1402', 'jensen@mail.com', 1, 0, '20076733580', '830.027.633-57', false, '$2y$10$C811NZ0XzesXoFjeHodglO.PFypyJIFe/LbKxGNH6x8XbMSRDWRU.');
INSERT INTO public."USUARIO" VALUES (1293, 'Henry Garin', '(28) 91235-9424', 'henry@iCloud.com', 2, 0, NULL, '789.042.915-00', false, '$2y$10$yuUsk8jlVa1tr2nqBNAZV.Ege/oeq4eBhsMzfBJEo580zAD2w8MW2');
INSERT INTO public."USUARIO" VALUES (1294, 'Matt Navrotsky', '(61) 92175-2106', 'matt@gmail.com', 2, 0, NULL, '731.724.242-00', false, '$2y$10$BgJWBgDnWckBUx8HwZ51QubBVeP6fZuzq16oJHDx0v5fpHS8RouQm');
INSERT INTO public."USUARIO" VALUES (1301, 'Florian Kondakov', '(95) 96191-6395', 'florian@iCloud.com', 2, 0, NULL, '653.554.252-16', false, '$2y$10$HI1AlAjJOXwAO6xyeaL71.Lv/tRx3TSGpp6YqQumeQiIqjT/ipXfy');
INSERT INTO public."USUARIO" VALUES (1302, 'Laurent Gubarev', '(43) 99940-3079', 'laurent@mail.com', 1, 0, '20073876110', '071.013.349-97', false, '$2y$10$GFTPacDKUTTrTrYfTeQ2Le5uafjI/tIeYgUoyDcp8bUmKTgObxUuO');
INSERT INTO public."USUARIO" VALUES (1305, 'Jacob Romanov', '(99) 97150-6535', 'jacob@outlook.com', 1, 0, '20086402863', '326.402.640-60', false, '$2y$10$ffH0FcFFZfdDEcHtgySiS.SybUGfDdYUlj9F4gO.wAhN3xV8BqagC');
INSERT INTO public."USUARIO" VALUES (1307, 'Donovan Grigorovich', '(82) 95857-5086', 'donovan@yahoo.com', 2, 0, NULL, '628.266.375-09', false, '$2y$10$/7.jm72dqnkG/YPGC3vglOF5gLM8r1snaxz/vace.lcL73n.IZBQS');
INSERT INTO public."USUARIO" VALUES (1308, 'Phinn Ignatiev', '(43) 97919-4544', 'phinn@mail.com', 1, 0, '20167424633', '057.267.432-53', false, '$2y$10$uDwV22T/7qB0cyvHp/ctMey85PfKEc2tDP3KsCLO.GYGr823vEuFC');
INSERT INTO public."USUARIO" VALUES (1309, 'Garrett Raevsky', '(18) 93223-3687', 'garrett@mail.com', 1, 0, '20033386443', '097.220.201-37', false, '$2y$10$WYyzpFTbYmxuRdRSph1KX.RTEZJKwzw9KD790FrPbeHchZmXUoqxi');
INSERT INTO public."USUARIO" VALUES (1311, 'Jansen Romanov', '(11) 99209-4147', 'jansen@iCloud.com', 2, 0, NULL, '930.750.437-70', false, '$2y$10$8oc7HtI9bfZIbPLcp4WO3ehJbmKw2a2E1zz9wmfOxNGTE/uDTBdWa');
INSERT INTO public."USUARIO" VALUES (1312, 'Gardner Lunin', '(92) 94413-6720', 'gardner@yahoo.com', 2, 0, NULL, '615.081.020-82', false, '$2y$10$0ns0VE6OFxC/1VlGj//T.OFSp71BUlyFBR/teMXIaFBsSnpT2oXRa');
INSERT INTO public."USUARIO" VALUES (1313, 'Maddox Sonin', '(65) 96906-8503', 'maddox@yahoo.com', 2, 0, NULL, '966.144.490-01', false, '$2y$10$FHj.ajI3yp5EvMDxWKIs1uv1D8AcXnhuIWQmwxsByAWMyEO6FtYiK');
INSERT INTO public."USUARIO" VALUES (1314, 'Orion Zhuravlev', '(67) 98356-8988', 'orion@zoho.com', 2, 0, NULL, '682.502.506-64', false, '$2y$10$fKgPuAyptUjzxJ8/4XwTLe3jd6P8FaSKxg5B8EcmbUO0nDLFdiDN2');
INSERT INTO public."USUARIO" VALUES (1315, 'Phineas Vorontsov', '(27) 99056-4416', 'phineas@gmail.com', 2, 0, NULL, '114.133.030-05', false, '$2y$10$WxKmI6RyylS1iaOSlwCVrOaz.xPqGVSR1lXFF.a1WcZx7KGpAsLOG');
INSERT INTO public."USUARIO" VALUES (1316, 'Hardy Chernyshev', '(38) 91114-8129', 'hardy@zoho.com', 1, 0, '20081281357', '640.582.076-98', false, '$2y$10$eYqHQqSjp./E3Ig5gKEcNupaGMm2TKCyVKepODZzXHyE9kREsyBz.');
INSERT INTO public."USUARIO" VALUES (1318, 'Ravi Shubin', '(55) 95327-5573', 'ravi@outlook.com', 1, 0, '20074218645', '093.710.081-13', false, '$2y$10$MYVVNnlHc4pzoFEZGbqAC.bvsnfdwX5r70XXFSCKqgDGd8qasVBJa');
INSERT INTO public."USUARIO" VALUES (1320, 'Carter Mamaev', '(74) 98328-9204', 'carter@iCloud.com', 2, 0, NULL, '901.666.620-62', false, '$2y$10$9m3wJGldhmNUEFzU0WuJjO7FHfzlitipnPhyLNRGquraE7cf1vQIi');
INSERT INTO public."USUARIO" VALUES (1321, 'Troy Mishchenko', '(92) 91665-8340', 'troy@iCloud.com', 2, 0, NULL, '416.863.824-30', false, '$2y$10$k/.O75jI6SrMiO3hV52XxuSF3dxQtd1e0fEV7H0/Fi/hFA8FpYcvW');
INSERT INTO public."USUARIO" VALUES (1323, 'Benjamin Petrov', '(48) 97073-6182', 'benjamin@iCloud.com', 1, 0, '20104018640', '976.456.264-70', false, '$2y$10$y1tS0kKwavgSoE0Wq662e.9A0LqUutQ7SGkA7kWv4kMojIrRzZ5SS');
INSERT INTO public."USUARIO" VALUES (1324, 'Giulio Shubin', '(82) 96154-7269', 'giulio@zoho.com', 2, 0, NULL, '200.453.613-63', false, '$2y$10$VDKhGLnypbO4399/X97Piue9w.uYnEC/Q5d1BuPhM2.HhIzO5nM3e');
INSERT INTO public."USUARIO" VALUES (1326, 'Javier Medvedev', '(97) 92186-6354', 'javier@mail.com', 1, 0, '20133814468', '392.154.860-89', false, '$2y$10$8fG4FL/lhgbapOX.qNpULebyVZ2UWy4cWd6T1QW871T7vUffhPdMG');
INSERT INTO public."USUARIO" VALUES (1327, 'Joey Verigin', '(77) 96540-2961', 'joey@outlook.com', 2, 0, NULL, '432.726.525-07', false, '$2y$10$C3byYpOzIoxafh57LaYfdOu5JMc1WVjKvmNFOsMRGkEz6WldU/9om');
INSERT INTO public."USUARIO" VALUES (1329, 'Thomas Kiselev', '(68) 95152-9331', 'thomas@zoho.com', 2, 0, NULL, '387.373.235-12', false, '$2y$10$f/Ix/y2YpkWjNpJhh3pVPOsd2cjfpytMQLspdtAPNwID4FMx7nMAW');
INSERT INTO public."USUARIO" VALUES (1331, 'Zeus Bulgakov', '(55) 92662-7223', 'zeus@iCloud.com', 1, 0, '20068177790', '408.888.601-10', false, '$2y$10$SxEi7Bik/bwv6Pvmb6tSiOeYVf3Zk1f8DmNI6Zy4gcHd.UlAMMGe6');
INSERT INTO public."USUARIO" VALUES (1332, 'Knox Demidov', '(74) 94655-4747', 'knox@yahoo.com', 2, 0, NULL, '328.849.566-03', false, '$2y$10$ujhBZa9NUp/XGUrJ//IplendMyt7gukT5FbspeGeDpJC5tEgiv24.');
INSERT INTO public."USUARIO" VALUES (1333, 'Tim Mukhanov', '(38) 98549-2050', 'tim@iCloud.com', 1, 0, '20142798694', '799.366.782-81', false, '$2y$10$IYgg7m/b7iPUJLvztqJbOOvQkETAqPgC72hup1Xq49cz9CbkLHWyy');
INSERT INTO public."USUARIO" VALUES (1334, 'Vaughn Baranov', '(77) 97917-9163', 'vaughn@outlook.com', 1, 0, '20169431626', '714.321.224-52', false, '$2y$10$WaW1XNKiJMAdDjzMh1YopujwDNZjV3ymLR97a1xWgb47M9RSJWP6S');
INSERT INTO public."USUARIO" VALUES (1335, 'Ravi Zhukov', '(92) 95331-2790', 'ravi@gmail.com', 2, 0, NULL, '519.887.180-07', false, '$2y$10$PqeF4x7FRbLe0dferhS0fe4MGHTCweJUKM2eMYC3VZhYgqOU/HLYO');
INSERT INTO public."USUARIO" VALUES (1337, 'Giancarlo Avdeev', '(28) 97528-5217', 'giancarlo@yahoo.com', 1, 0, '20072131270', '148.810.572-35', false, '$2y$10$PxUF7Gs/58moL.ppd/RETO9xQsPIaCZr6OhJWI8kUvgP0Dg7hKvrO');
INSERT INTO public."USUARIO" VALUES (1338, 'Sebastian Bykov', '(31) 96001-5991', 'sebastian@gmail.com', 2, 0, NULL, '002.154.731-91', false, '$2y$10$EqJluwJxn26Azw4I5IIpS.kj7.2HwoTBFqm6OLnh9i/1vtUA.abo6');
INSERT INTO public."USUARIO" VALUES (1339, 'Hektor Seletsky', '(67) 94330-2228', 'hektor@mail.com', 1, 0, '20063778727', '494.975.125-54', false, '$2y$10$2erS1a9FMZkEQpw3pzfWceIX2Bm4dkYyqgY6cUtsYpn7SJZWQXDo6');
INSERT INTO public."USUARIO" VALUES (1341, 'Henrik Zhuravlev', '(43) 92125-7631', 'henrik@gmail.com', 2, 0, NULL, '277.683.449-79', false, '$2y$10$f7adJxVJniy36XI.bkSBm.83EPH7UMkyBdOPnWV1uq2e93l6WVZBi');
INSERT INTO public."USUARIO" VALUES (1342, 'Sebastian Bibikov', '(19) 95010-6983', 'sebastian@iCloud.com', 1, 0, '20126498382', '723.806.141-48', false, '$2y$10$JELoBBKvrEXK2J7Dwg/06OfV8O5GWZi4Nn7ComyHQW5bDzQmf9kRO');
INSERT INTO public."USUARIO" VALUES (1344, 'Tim Avdeev', '(65) 91383-7374', 'tim@outlook.com', 1, 0, '20189659984', '597.318.821-38', false, '$2y$10$ya7rGGubIJADU4m7c/1UpOs21mQT.ObRtZfgFetS35qUjhrV7fKA6');
INSERT INTO public."USUARIO" VALUES (1345, 'Stan Malinovsky', '(33) 96749-7362', 'stan@mail.com', 1, 0, '20079617264', '601.263.069-74', false, '$2y$10$nlkhhdgSZ8PZcnlQziBS.OJFWobTDGePkcRVmxFT/YnnOSAY7ilh.');
INSERT INTO public."USUARIO" VALUES (1346, 'Geovanni Mishchenko', '(68) 96927-2256', 'geovanni@iCloud.com', 1, 0, '20195178728', '194.307.480-17', false, '$2y$10$dg532fwXxzA8GXhcLJ7ACei2UAtqhf6yO8HIYbqqtySe7L02y9CK.');
INSERT INTO public."USUARIO" VALUES (1347, 'Reed Tomilin', '(11) 92682-5780', 'reed@outlook.com', 1, 0, '20195087256', '671.534.830-80', false, '$2y$10$zJjXdJgVAFQyc3ps3opdgeOZeEMULUTbkHxmQS162JIr2eWXdPkFW');
INSERT INTO public."USUARIO" VALUES (1348, 'Riley Romanov', '(89) 99607-4856', 'riley@outlook.com', 2, 0, NULL, '194.159.174-40', false, '$2y$10$dma7gkb2kFkPHT2GHeDwlOLVXc0wcDC0YtaSKPUKgTLOYG0P6qPTq');
INSERT INTO public."USUARIO" VALUES (1349, 'Blaine Gordeev', '(86) 95847-4363', 'blaine@outlook.com', 1, 0, '20198266764', '154.324.809-80', false, '$2y$10$dYe0TJW58tyuxgkl/zJZUelET.b4RAEcO1DwY.RLgkRbEauFxbBZW');
INSERT INTO public."USUARIO" VALUES (1351, 'Floyd Kozin', '(28) 96323-8254', 'floyd@yahoo.com', 2, 0, NULL, '223.160.649-65', false, '$2y$10$0f9ktVBDaXGuI.CjY2Y32uOEFZJpCwFoaiTLV1zSNG7/dA9o/X1Am');
INSERT INTO public."USUARIO" VALUES (1353, 'Holden Vasiliev', '(84) 99243-7791', 'holden@zoho.com', 1, 0, '20191293166', '370.787.133-97', false, '$2y$10$estLgbB4g4z1fvKleTHL3OYz.DUpwTNWH8Jp7BAiDiErP6yvwf8WK');
INSERT INTO public."USUARIO" VALUES (1354, 'Giles Sokolovsky', '(49) 98001-2007', 'giles@iCloud.com', 2, 0, NULL, '345.199.836-06', false, '$2y$10$rg9K7E0DnQjeZQia05YbleW5CiPGYuODZIWq76AFJaEjSzJKlaq2.');
INSERT INTO public."USUARIO" VALUES (1356, 'Kipp Korolkov', '(89) 93456-9465', 'kipp@mail.com', 2, 0, NULL, '395.714.560-04', false, '$2y$10$09jp7881NB.QInRX.N3Zveb6hiPs6R.on6Bgszb9WexV3Q5ct5etG');
INSERT INTO public."USUARIO" VALUES (1361, 'Viggo Tatarinov', '(53) 92059-6849', 'viggo@yahoo.com', 2, 0, NULL, '762.969.299-43', false, '$2y$10$YRqkoNy6M1uuN7GYE27Cye.bCfrV0YrNxN6RcRn1UDEg2o6odmFqy');
INSERT INTO public."USUARIO" VALUES (1362, 'Dylan Korovkin', '(79) 99217-9421', 'dylan@outlook.com', 1, 0, '20182025445', '415.017.815-10', false, '$2y$10$p5p6OH4l6iX2KP/fMaoHf.tjcmnYAQQuyfWFQEbxnwxmVKvHk79Yi');
INSERT INTO public."USUARIO" VALUES (1365, 'George Sinitsyn', '(79) 91453-2910', 'george@yahoo.com', 1, 0, '20169311454', '511.097.836-04', false, '$2y$10$a8X4LclZhmsncyBwhkFILeITALaRxWDS8PPeYzWX0CYbM63yui4xC');
INSERT INTO public."USUARIO" VALUES (1366, 'Mateo Tokarev', '(83) 97592-1558', 'mateo@iCloud.com', 1, 0, '20115659529', '765.316.135-99', false, '$2y$10$27L4z/HRl87Ooh8tAa8dBekVb/iryfc.adys1jmd2ImW6dZ8qw/yW');
INSERT INTO public."USUARIO" VALUES (1367, 'Mathew Demidov', '(71) 99028-7252', 'mathew@zoho.com', 2, 0, NULL, '115.208.884-06', false, '$2y$10$ApaNAUro00WrUhldIORrbe4PBHAaJKeuZRpGvkZRUPzR0gXunmNzW');
INSERT INTO public."USUARIO" VALUES (1369, 'Nico Verigin', '(83) 98734-9697', 'nico@gmail.com', 2, 0, NULL, '064.512.458-36', false, '$2y$10$wnpL0vBtrDGASSPvvH/Cru1mOwo7dUgHeMJLCyDZkRylvZjRWde9u');
INSERT INTO public."USUARIO" VALUES (1370, 'Meyer Kalugin', '(41) 94720-7752', 'meyer@outlook.com', 2, 0, NULL, '997.082.138-53', false, '$2y$10$Ig0n7KDUxl1SYlp8/bvjzeepUMCoyBaY0MRiRYgjTAgRM0uRJYlPq');
INSERT INTO public."USUARIO" VALUES (1371, 'Donovan Ilinsky', '(11) 97101-3142', 'donovan@zoho.com', 1, 0, '20189299382', '712.928.709-82', false, '$2y$10$vYshCFVJA7lHciiULvE3d.jzorrRi7akv899lYGVEr77NVULIV6uW');
INSERT INTO public."USUARIO" VALUES (1372, 'Grayson Bachurin', '(34) 93195-1107', 'grayson@iCloud.com', 2, 0, NULL, '827.697.875-43', false, '$2y$10$KYZ4aUQsE4CABW9xfQZEQOafdkJ/oTJdTitsaEQnAFrYkWlHLzrQe');
INSERT INTO public."USUARIO" VALUES (1373, 'Tyler Markov', '(86) 97660-4883', 'tyler@yahoo.com', 1, 0, '201884790', '085.559.923-54', false, '$2y$10$vl2U8lQoBBC4QjVynVufvetdUihyiQ/j08GzzHVmxzXHpjkAZ5gDa');
INSERT INTO public."USUARIO" VALUES (1374, 'Carter Viazemsky', '(88) 94099-6845', 'carter@mail.com', 2, 0, NULL, '919.787.194-00', false, '$2y$10$NOAq6J3RH.vbv6Tr9SrpaeIvhSerFsbgSpsK68DB78dfZE2LY/8.2');
INSERT INTO public."USUARIO" VALUES (1375, 'Donovan Ivanov', '(55) 93409-6941', 'donovan@gmail.com', 1, 0, '20104773965', '094.226.396-03', false, '$2y$10$wnglgEl.q4eB/3nJiCRlq.gZiEN0NfSiZdD73.iB49y7hcM9iy2LG');
INSERT INTO public."USUARIO" VALUES (1376, 'Sean Mikhalkov', '(32) 94950-4509', 'sean@mail.com', 2, 0, NULL, '262.664.538-94', false, '$2y$10$2gAWBS30FdMe3bqxI/NW2OAx63FfvASPVCxVd9Pz870fBLr7Z4Tl2');
INSERT INTO public."USUARIO" VALUES (1377, 'Steven Merkulov', '(89) 98925-4351', 'steven@outlook.com', 1, 0, '2012187135', '630.098.872-48', false, '$2y$10$1fuZg6Ppd9Uyr19P4oyWPeyqUcv34FTT/WTWONUaPU8xTCON8/tyu');
INSERT INTO public."USUARIO" VALUES (1378, 'Tyler Kireev', '(54) 94933-4255', 'tyler@zoho.com', 2, 0, NULL, '299.684.208-16', false, '$2y$10$UCf37fISZK0zfftf89R2a.8lmUCZCxb/ODgXrS6kbli0.wq9O6ZAK');
INSERT INTO public."USUARIO" VALUES (1380, 'Nico Gagin', '(66) 93880-5452', 'nico@mail.com', 1, 0, '20057889037', '573.885.472-15', false, '$2y$10$Y5NatUOXrP3hsGnjAgCS0.22FZ/8ieK1YXKDf2eATal87726sh4Qi');
INSERT INTO public."USUARIO" VALUES (1384, 'Grayson Novikov', '(97) 97070-3159', 'grayson@mail.com', 1, 0, '20108063645', '216.798.964-40', false, '$2y$10$VEM6dxukyZcyKKcp/4kyF.AkRu5jdx/nxIlcH2JR.Nz09gKknz/VW');
INSERT INTO public."USUARIO" VALUES (1385, 'Meyer Suvorov', '(89) 97747-1843', 'meyer@zoho.com', 1, 0, '20139426030', '574.513.859-90', false, '$2y$10$/ppIbJZKVumPE28uCuQMD.xQJpeyLLVKpDtpL29jtAr2Iwg3/E01C');
INSERT INTO public."USUARIO" VALUES (1391, 'Diesel Gladkov', '(88) 97634-8084', 'diesel@outlook.com', 2, 0, NULL, '797.598.647-03', false, '$2y$10$YpW0ElmpSGptTvVlakTXPuiZqAjiBoQVVOajVtkCGSXk2Zr1sfZ5.');
INSERT INTO public."USUARIO" VALUES (1392, 'Harvey Balakirev', '(67) 93122-6613', 'harvey@outlook.com', 1, 0, '20089245267', '251.736.342-00', false, '$2y$10$X9G7PH9zRdQvP7e/bCKPauMcvzKjIS7s54BnKzxp5SbRG8FvT3UZC');
INSERT INTO public."USUARIO" VALUES (1393, 'Nicholas Stepanov', '(81) 96125-2023', 'nicholas@iCloud.com', 1, 0, '20068741020', '300.373.886-06', false, '$2y$10$.uuzB5ub/voZx50wfT2/SOzIg23WxufZEsRq.8VHdlqwaDAkhLApC');
INSERT INTO public."USUARIO" VALUES (1394, 'Micah Borisov', '(28) 93392-8782', 'micah@iCloud.com', 2, 0, NULL, '717.483.316-04', false, '$2y$10$3pxy0Nc8Wk1uEVQmhQXyiOR/J0rkJ8cCcoPQmuBEvCB0wyWl9/PFC');
INSERT INTO public."USUARIO" VALUES (1397, 'Peter Mishchenko', '(43) 98870-6409', 'peter@outlook.com', 2, 0, NULL, '215.566.258-04', false, '$2y$10$GVCsAOctLVm2Ro1gtpqQ1uwIwh5dAkcklU45sHhzwofmX8OgrOJ/i');
INSERT INTO public."USUARIO" VALUES (1400, 'Mathias Lukin', '(61) 96802-2297', 'mathias@yahoo.com', 2, 0, NULL, '687.826.695-54', false, '$2y$10$I0Y/VzE5iH5pg27lId2PwevXy0NpNmICoSoZ8MhgIfXayyb/ICtlq');
INSERT INTO public."USUARIO" VALUES (1228, 'Jonah Mishin', '(37) 94421-1558', 'jonah@mail.com', 3, 0, '20111467120', '270.903.231-70', false, '$2y$10$8KjAKiq4JeKQQYustHr8i.1XfbrAX85lwie1OxcgbU8FLps7Mf/d6');
INSERT INTO public."USUARIO" VALUES (1234, 'Magnus Nestorov', '(95) 95593-4359', 'magnus@yahoo.com', 3, 0, '2013639760', '609.906.180-05', false, '$2y$10$MbCr4J5DH2CMM5qSwEJeYOGPn2.ZMufcbEmwM5Ig561JbFSpGXeZq');
INSERT INTO public."USUARIO" VALUES (1235, 'Yoan Vasiliev', '(33) 98184-9195', 'yoan@mail.com', 3, 0, '20197532350', '058.272.225-00', false, '$2y$10$IRSQFVdRn3BSbljMqBJ1UuTEylD3/LUrWkAeXW9KX/j7k4qGlycjS');
INSERT INTO public."USUARIO" VALUES (1239, 'Flynn Telegin', '(15) 97297-8185', 'flynn@outlook.com', 3, 0, '20036632880', '596.831.314-50', false, '$2y$10$A/fUP8Fz2QM6rSg2mFpaZeeO0l0pnW62r3wGlr2i2sRKgoqtT43qa');
INSERT INTO public."USUARIO" VALUES (1243, 'Kurt Stoianov', '(28) 99436-1139', 'kurt@yahoo.com', 3, 0, '20037992645', '314.496.333-07', false, '$2y$10$F5xOnnQz.pLu4vJxuMaHw.IZNO3jlAgbux/08DIdz0zgVBTGc8gNO');
INSERT INTO public."USUARIO" VALUES (1205, 'Hiro Dmitriev', '(75) 95724-9936', 'hiro@mail.com', 3, 0, '20002817065', '369.325.018-99', false, '$2y$10$YHqxuhMlG5mvH2ICcrMlTOOvKBLDMI7Rgw5obPMPHp4dRvgptd5Su');
INSERT INTO public."USUARIO" VALUES (1208, 'Ian Kiselev', '(46) 93699-9860', 'ian@yahoo.com', 3, 0, '20086711688', '042.832.701-05', false, '$2y$10$AoYafpJBzmlSRTee46IrzOOKMLhmATlfWMbMvtzrKEEusp/kAcSKu');
INSERT INTO public."USUARIO" VALUES (1209, 'Sean Malinovsky', '(84) 93001-5051', 'sean@zoho.com', 3, 0, '20167632076', '160.412.412-10', false, '$2y$10$MhiQGy/BEY2lsFKR6HQYt.NisSqFDrYAOWnIdKRV6XJijEqTk.G4G');
INSERT INTO public."USUARIO" VALUES (1210, 'Leo Balashov', '(14) 93580-1309', 'leo@zoho.com', 3, 0, '20138104714', '381.330.012-93', false, '$2y$10$Rw7XpuAbE1lsiRQeiLYiFe4BPWPLgUJr/rgcFT4dnFxlnmxs.midq');
INSERT INTO public."USUARIO" VALUES (1211, 'Hudson Obukhov', '(96) 92194-3516', 'hudson@yahoo.com', 3, 0, '20025086437', '427.063.792-78', false, '$2y$10$hgb1fHXIBK3.gsZSjiqN.OyQlilnn08R1sXSqlwu0f9UUQBQOpCpy');
INSERT INTO public."USUARIO" VALUES (1212, 'Jared Starov', '(64) 97100-5977', 'jared@yahoo.com', 3, 0, '20019901893', '964.162.633-78', false, '$2y$10$z2QLvkRivNXug6F2b0h1neMKoCFACpy8vjy8YygMDEvlDsnOsDkca');
INSERT INTO public."USUARIO" VALUES (1216, 'Thor Uvarov', '(14) 91388-9027', 'thor@iCloud.com', 3, 0, '20021632973', '867.844.294-86', false, '$2y$10$pPl16TdrWniWe3brUKZwreYreDCWAlLxh.Sziz6NHtl4iteqt/QKa');
INSERT INTO public."USUARIO" VALUES (1219, 'Sacha Naumov', '(83) 99068-2158', 'sacha@yahoo.com', 3, 0, '20164398301', '792.656.964-00', false, '$2y$10$yGsoHu9YwFooJiZ4l6WGm.DOx6UdYehRBePtwudzYNrzGFrfKB2La');
INSERT INTO public."USUARIO" VALUES (1221, 'Yannick Skuratov', '(73) 95874-3176', 'yannick@yahoo.com', 3, 0, '20106223587', '626.589.021-23', false, '$2y$10$hBa/RmXSlIU4t/qU0SCcKOsn0BeFCCgmAH7d9CBIhASrFQkdsUX5O');
INSERT INTO public."USUARIO" VALUES (1222, 'Tatum Samsonov', '(35) 98939-3958', 'tatum@zoho.com', 3, 0, '20129063380', '119.199.473-29', false, '$2y$10$X.AIS457BFXrb4FHmXT8M..KFW8LXh5M49eGhhgD7AUFJImz3oy/C');
INSERT INTO public."USUARIO" VALUES (1226, 'Reef Sinitsyn', '(69) 94651-9822', 'reef@iCloud.com', 3, 0, '2013681579', '200.289.913-46', false, '$2y$10$6RjogFilnVeB8f85bAllJeFRcoulgPdaYt6S34EgnxL4B5QykmS5O');
INSERT INTO public."USUARIO" VALUES (1245, 'Marc Danilov', '(46) 95831-8696', 'marc@iCloud.com', 3, 0, '20079757525', '300.343.193-52', false, '$2y$10$faL0BYLRqdl/5hsc1C1DP.ywwxrmtIAil2ijcG6V6DnhtZsgzE042');
INSERT INTO public."USUARIO" VALUES (1247, 'Enzi Makarov', '(17) 91598-3289', 'enzi@gmail.com', 3, 0, '20048106760', '843.576.389-76', false, '$2y$10$jzZx/cJq1W9A8QK1a4no2OcR2PWeQwqxKU6r/eWp7MD1758A15Etu');
INSERT INTO public."USUARIO" VALUES (1248, 'Ioan Baryshnikov', '(51) 98775-5337', 'ioan@zoho.com', 3, 0, '20143821494', '620.851.704-47', false, '$2y$10$/QCtuDFmxx3GAHbaPbuzfOMgahH8SP6pdfn6YN8WoXD5Ju5Kt6JEu');
INSERT INTO public."USUARIO" VALUES (1249, 'Grant Olenin', '(61) 98155-3173', 'grant@gmail.com', 3, 0, '20166181619', '887.877.787-00', false, '$2y$10$6UH4VrrMHLP8Ngf1yyIp1u1WJY3V1UV82tVEqoDrcmqJBIkirvrzW');
INSERT INTO public."USUARIO" VALUES (1250, 'Rowan Novikov', '(53) 94842-8045', 'rowan@mail.com', 3, 0, '20143959737', '720.783.246-04', false, '$2y$10$xDfWf6xBflTGre6kEO19ruwNYu.qR7zKAM67RbFIir87NbZZbcxom');
INSERT INTO public."USUARIO" VALUES (1252, 'Bryan Alekseev', '(49) 91210-7577', 'bryan@yahoo.com', 3, 0, '20129768180', '728.837.818-77', false, '$2y$10$2alJ1Bci3xlzI43S5M3MbOD2skYSMQGb1NEpc9DMdbW2N4E6RXFJq');
INSERT INTO public."USUARIO" VALUES (1253, 'Griffith Cherkasov', '(51) 95246-5553', 'griffith@outlook.com', 3, 0, '20012255376', '810.584.314-55', false, '$2y$10$rfpuiPMsMVWCHeZSRVpLVurP.3cb4mPf/I1S5CNygcCdtXJ0E0cwG');
INSERT INTO public."USUARIO" VALUES (1256, 'Gio Komarovsky', '(81) 91264-9420', 'gio@iCloud.com', 3, 0, '20016337977', '933.645.501-07', false, '$2y$10$NVgrhYPIY4Z3GvwRlvkm3uM5y5jdsHsOCLZtbHNeApa5LXGfi4ahK');
INSERT INTO public."USUARIO" VALUES (1261, 'Dorian Chebotarev', '(13) 97461-2830', 'dorian@zoho.com', 3, 0, '20006442248', '424.500.171-27', false, '$2y$10$EVPS2833EJ0vYUXCJrcp.eLddI2K.xmblEztvgVjW94k9fCdIF1f.');
INSERT INTO public."USUARIO" VALUES (1263, 'Fabien Stoianov', '(21) 98191-8582', 'fabien@yahoo.com', 3, 0, '20057448521', '658.475.263-18', false, '$2y$10$QSe5L9dKYmd9fMHWYcHAH.J8DFMlRGzX9SdZP2VgVcnjbiUyVqAUS');
INSERT INTO public."USUARIO" VALUES (1267, 'Elijah Galagan', '(85) 93468-2049', 'elijah@yahoo.com', 3, 0, '20168622795', '053.454.588-20', false, '$2y$10$XjNGxoKFHZsfaFfChzfHFOM0k7F4bZw88GvVJGW.mFpj9Ft7.hHHK');
INSERT INTO public."USUARIO" VALUES (1268, 'Dylan Pavlov 2', '(35) 97250-4661', 'dylan@yahoo.com', 3, 0, '20198402574', '052.434.103-65', false, '$2y$10$VlPdbad345xsI2RC4pTzC.nGeN5KsFpiojT572hVbdz9gMk3bCLuy');
INSERT INTO public."USUARIO" VALUES (1269, 'Brooke Belkin', '(64) 97272-6329', 'brooke@iCloud.com', 3, 0, '20194013313', '822.364.078-31', false, '$2y$10$MOcxlefLJFaUpepP8GcDRu3xMD5GjgIHlDGDGBJ9nOkbJaLiWsAD2');
INSERT INTO public."USUARIO" VALUES (1270, 'Mathew Mitrofanov', '(19) 94413-4259', 'mathew@iCloud.com', 3, 0, '20142981968', '821.420.866-16', false, '$2y$10$douJeHEwFrMMiQQDvD14rup2WxMJUeoK/tvhLY4ooZgcXkGDk8OwC');
INSERT INTO public."USUARIO" VALUES (1273, 'Marc Nazarov', '(46) 93027-9225', 'marc@zoho.com', 3, 0, '20123953250', '517.160.368-52', false, '$2y$10$FidJFe27fWXABuEpQACOFeE.6wBeVa0.ywqf3x7CCBzV4ds0w1OTy');
INSERT INTO public."USUARIO" VALUES (1274, 'Griffin Mishin', '(35) 92991-6367', 'griffin@zoho.com', 3, 0, '20071113710', '681.925.022-36', false, '$2y$10$GTDbcoSJ3H2fFRFpowv4Se./uN4yISzFWl1snGnwcWGzHYXhGznpi');
INSERT INTO public."USUARIO" VALUES (1278, 'Juan Mikulin', '(22) 93369-9177', 'juan@zoho.com', 3, 0, '20012446050', '171.859.563-82', false, '$2y$10$qS.kvOVAXb6NYBkRwo5iAuS.ItikRwMicngD1Bo6.dFubwohvYsoa');
INSERT INTO public."USUARIO" VALUES (1280, 'Jayden Krivtsov', '(87) 98717-1709', 'jayden@gmail.com', 3, 0, '20102146569', '792.302.491-06', false, '$2y$10$b4E61BuZE8FsC5V4SCh4X.Xk05iEapHxGXlJd3VeSRVxuyks/oI5q');
INSERT INTO public."USUARIO" VALUES (1282, 'Enrico Korolkov', '(86) 97439-5992', 'enrico@gmail.com', 3, 0, '20166027923', '091.391.763-04', false, '$2y$10$fzGPqgTmjAAi9auqYW9fb.HHhEwg.LcRKgkV0p7AlI8dDbIALfDn.');
INSERT INTO public."USUARIO" VALUES (1283, 'Enrique Orlov', '(87) 95951-1417', 'enrique@outlook.com', 3, 0, '20037075985', '193.013.137-23', false, '$2y$10$5tnHLfRYjXPvBCEbDu3gxeSZOB.LeciqoMHrWNhead..zCTwC6oOy');
INSERT INTO public."USUARIO" VALUES (1288, 'Ryan Basov', '(13) 96369-4754', 'ryan@mail.com', 3, 0, '20028344068', '935.471.257-66', false, '$2y$10$MnWh8Itgs1KCUh2xDyHJj.EtE4YPcvY7UHXSBZVH9srJvxlBZAH4e');
INSERT INTO public."USUARIO" VALUES (1295, 'Hardy Bakhtin', '(47) 98547-9035', 'hardy@gmail.com', 3, 0, '20012853601', '053.195.720-93', false, '$2y$10$7raLM4l7ogvNm5tlVpdzvetbugdhMwtw.GmwHBzLOyoG6HsILdxuy');
INSERT INTO public."USUARIO" VALUES (1296, 'Pierre Zotov', '(14) 99623-1782', 'pierre@mail.com', 3, 0, '20097764140', '656.931.955-89', false, '$2y$10$87u8TQT4s.ThvEkI82J6R.Qw05XrW/8wzOM6tJASDqk6Vp0copESK');
INSERT INTO public."USUARIO" VALUES (1297, 'Dilon Obukhov', '(64) 92656-2774', 'dilon@outlook.com', 3, 0, '20106631043', '157.928.270-95', false, '$2y$10$eY7EGwP1VfrezWROPdr6PuHRzQQRVxRoBZViHKeCRuF7LMlo6Jqfu');
INSERT INTO public."USUARIO" VALUES (1298, 'Nathan Chesnokov', '(55) 92198-3805', 'nathan@zoho.com', 3, 0, '20026583092', '797.069.441-17', false, '$2y$10$comS18JVLVfZhcDC7YGyg.nCJXCAUyIA9ULtZbYQsVzRtG1uiJmjq');
INSERT INTO public."USUARIO" VALUES (1299, 'Josiah Satin', '(27) 98125-9180', 'josiah@zoho.com', 3, 0, '20159604573', '260.973.362-33', false, '$2y$10$CljXQfk7Oiw.2l5LdwKO.efu7KgKhidZSxDDtxrpc.ywKXCnR85UO');
INSERT INTO public."USUARIO" VALUES (1300, 'Knox Vlasov', '(27) 96005-2337', 'knox@mail.com', 3, 0, '20129814438', '720.100.716-54', false, '$2y$10$9EqBoPQ6s/x7xXe.qgQFLOI2oQ6DndQWRVAYuOdFuEObAWwuFaSPu');
INSERT INTO public."USUARIO" VALUES (1303, 'Hiro Ozerov', '(31) 98041-9639', 'hiro@zoho.com', 3, 0, '20056741198', '063.782.986-70', false, '$2y$10$5htuBia/PsUDhpGejZhLO.sxgnoiIXWXtTA.3JT2kyQshlqjQXNdm');
INSERT INTO public."USUARIO" VALUES (1304, 'Geovanni Panin', '(14) 93017-7535', 'geovanni@outlook.com', 3, 0, '2000325984', '653.645.529-00', false, '$2y$10$gjAxyxYuKl5hnatTgi298ux/Hn0Tr3APs6Ou3AeGEYQDkG2n4HFZi');
INSERT INTO public."USUARIO" VALUES (1306, 'Javier Krivtsov', '(68) 98760-8257', 'javier@zoho.com', 3, 0, '20043685474', '752.436.260-90', false, '$2y$10$Dndthx/9vueJpWLYnCxXz.4SyWwPFhnQ9B4m4Aa3JIyt6fbYZh2xC');
INSERT INTO public."USUARIO" VALUES (1310, 'Lou Pestov', '(82) 96352-1305', 'lou@mail.com', 3, 0, '20092429088', '803.790.097-57', false, '$2y$10$OEm8zT10A2nMpLJoDCCaOeQI/hpAslwRH9qQVMIlItS1HASNlX56u');
INSERT INTO public."USUARIO" VALUES (1317, 'Ryland Bazin', '(71) 91019-6764', 'ryland@gmail.com', 3, 0, '20184985064', '019.256.285-15', false, '$2y$10$a5lfiWS5.8FK1dpgRcMF8uygeNKmYqhwrsYOo/oSXH6Pas906I6DC');
INSERT INTO public."USUARIO" VALUES (1322, 'Riley Aristov', '(15) 98882-8407', 'riley@gmail.com', 3, 0, '20163536559', '932.577.523-93', false, '$2y$10$mLdRAl0WgWSoriBUY.kgmuqcGSZTKv7cj6Fyub0Aqfr1ko97zUJhW');
INSERT INTO public."USUARIO" VALUES (1325, 'Lucas Izmailov', '(91) 92382-8709', 'lucas@mail.com', 3, 0, '20176746248', '251.903.199-97', false, '$2y$10$xREHv2MEPZ9y7UaK5qIowuBZES5TZjwJhKeAM85PmJfjq0mwYNEJi');
INSERT INTO public."USUARIO" VALUES (1328, 'Benjamin Khomutov', '(67) 91149-2800', 'benjamin@gmail.com', 3, 0, '2006703050', '465.246.330-83', false, '$2y$10$BL2N5Mj3inLfF.9XDeeqXOuMnMCQGZ8PBK5CHYBLZW0/VnbWRRrLW');
INSERT INTO public."USUARIO" VALUES (1330, 'Max Yavorsky', '(75) 91215-6287', 'max@iCloud.com', 3, 0, '20194929494', '674.219.169-46', false, '$2y$10$Y1SrYunFyrtTfusfZar7Le2fK0EquN9utROw2zVoN6oVN0oIT85Si');
INSERT INTO public."USUARIO" VALUES (1336, 'Rhys Gordeev', '(74) 94869-1417', 'rhys@gmail.com', 3, 0, '20038798879', '647.232.505-73', false, '$2y$10$1r9E7BnMU3kD1512pqSCY.Fst3asW9/uSHoAfT9Eeul4hLuGo0bdi');
INSERT INTO public."USUARIO" VALUES (1340, 'Humphrey Petrov', '(32) 97779-6748', 'humphrey@outlook.com', 3, 0, '20001145861', '372.236.587-20', false, '$2y$10$ZxE/I6SJVuGFpEWyd0x22e26r4em6oeRBQ2Manefn10dFm6R3040G');
INSERT INTO public."USUARIO" VALUES (1343, 'Owen Molchanov', '(67) 91962-8694', 'owen@mail.com', 3, 0, '20132645134', '726.734.238-85', false, '$2y$10$WBZ4rqKuEHW3g1aLMArtH.Ta12t2CRAlfivBqVghFJ8zzgkcG.HFm');
INSERT INTO public."USUARIO" VALUES (1350, 'Martin Trofimov', '(67) 91566-5897', 'martin@mail.com', 3, 0, '20124402764', '376.990.270-00', false, '$2y$10$iHMSTTIrZhZ8Ds8e0FJUZelLi7JrldQapGTPW74uYMfKrSXiBchG6');
INSERT INTO public."USUARIO" VALUES (1352, 'Eliah Ivanov', '(65) 96147-3142', 'eliah@mail.com', 3, 0, '20046551662', '597.059.254-45', false, '$2y$10$eQmL7.gxG80P4FNTCHHQj.KTesy1G1hZzJFwqqjXQ1FyKiAHyyl5K');
INSERT INTO public."USUARIO" VALUES (1355, 'Mattia Kiselev', '(88) 93521-5943', 'mattia@mail.com', 3, 0, '20004876346', '022.847.385-32', false, '$2y$10$fUJAj0dPPhQOwTnD/TSyO.Fy5f9w7TYvoEvMMVNPW5e2AqW9aw3Ee');
INSERT INTO public."USUARIO" VALUES (1357, 'Kingston Grigoriev', '(11) 95978-7835', 'kingston@zoho.com', 3, 0, '20041272478', '030.294.605-50', false, '$2y$10$Pmh2Q8FhVC6I7xsTrZBzZu152UNhXMZ/WBFBqSJyBQXaEDOxUwlwa');
INSERT INTO public."USUARIO" VALUES (1358, 'Skylar Bachurin', '(91) 92946-9470', 'skylar@outlook.com', 3, 0, '2009797964', '343.490.225-20', false, '$2y$10$tNN1nQzu05I/DFSiXeKoE.mTWskeVzpwzn7mFRMo5MAhnhelius9.');
INSERT INTO public."USUARIO" VALUES (1359, 'Pierre Ignatiev', '(96) 92699-3394', 'pierre@outlook.com', 3, 0, '2000516616', '364.589.704-63', false, '$2y$10$ziHsI0sEM1mxr5h5Czepte27ZR4/eVGNywq.G/6r8Q8PO5caMXK/a');
INSERT INTO public."USUARIO" VALUES (1360, 'Emery Mikulin', '(81) 91277-1978', 'emery@yahoo.com', 3, 0, '20193864461', '277.977.772-92', false, '$2y$10$u63Pd2V5KEp712EPO3WZye700jgdb8.qnbTNXtkI4aXXFcVXlxv6a');
INSERT INTO public."USUARIO" VALUES (1363, 'Gary Demidov', '(54) 93486-8223', 'gary@outlook.com', 3, 0, '20071136615', '207.533.536-28', false, '$2y$10$WhSgIKrQCC6EBtBh5GrfQOWlLS6WjBrJypxRXmH5r3b5TGUHB0MEq');
INSERT INTO public."USUARIO" VALUES (1364, 'Mason Mikhalkov', '(14) 91600-5997', 'mason@mail.com', 3, 0, '20165635033', '105.336.468-71', false, '$2y$10$65t1IbEjGb5fHGNnnuoGi.v062EPTC79rXUDKNUGbWrg3j9heP5Om');
INSERT INTO public."USUARIO" VALUES (1368, 'Carter Shishkov', '(22) 91651-6558', 'carter@zoho.com', 3, 0, '20062481606', '888.147.514-63', false, '$2y$10$kd4CPcRy0PRfFJq88ypKle716zlwfeDdElzbR4J5yuFz1UUe8.oJi');
INSERT INTO public."USUARIO" VALUES (1379, 'Nicola Lobanov', '(44) 95792-3059', 'nicola@gmail.com', 3, 0, '20141816138', '496.982.324-35', false, '$2y$10$J0ZO5XJF8mlN6ukODXxseOAkFPY6Y.0GlzbaEr2Y8fEuZlAk5QSAe');
INSERT INTO public."USUARIO" VALUES (1381, 'Brooke Nestorov', '(91) 94942-5823', 'brooke@outlook.com', 3, 0, '20172221355', '168.453.447-01', false, '$2y$10$E4EkLE1rRkLfaEYEI9LwguhYbpdyhLw6YNYddVhakn8S9qR34LYyu');
INSERT INTO public."USUARIO" VALUES (1383, 'Meredith Shevtsov', '(66) 93816-6486', 'meredith@zoho.com', 3, 0, '20111735571', '915.829.746-40', false, '$2y$10$MNxgSyGibmbckJz5GKGGV.0rZ5nY1NCVmm3Nc605/.gc28Tb7zHey');
INSERT INTO public."USUARIO" VALUES (1386, 'Theo Kuchin', '(48) 94370-2689', 'theo@iCloud.com', 3, 0, '20107377029', '027.968.328-64', false, '$2y$10$2Adno3Fz9fCzoviutL2f1.L.Dtt5uGurTFBc5T2FzWO1tdWQDixVS');
INSERT INTO public."USUARIO" VALUES (1387, 'Giancarlo Stoianov', '(68) 99697-8332', 'giancarlo@outlook.com', 3, 0, '20021037224', '437.947.258-24', false, '$2y$10$cT1fUmtyjL4BotdyXDETQemg8PT9GI6umpvLXdjtZIHD4ARNpVR8e');
INSERT INTO public."USUARIO" VALUES (1388, 'Kingsley Urbanovich', '(81) 98604-3998', 'kingsley@iCloud.com', 3, 0, '20057233635', '059.618.936-26', false, '$2y$10$QKaQrn4Osr0RnCC7d4M5OOq3TRh7zAFSNu146i2RgTxsmTWJ0Hmje');
INSERT INTO public."USUARIO" VALUES (1389, 'Keeran Trotsky', '(27) 91964-1735', 'keeran@iCloud.com', 3, 0, '20125167328', '154.683.908-92', false, '$2y$10$eH8UX9Ah0yPXx547W1sL1.QX457Lxj8bBQgYUxMsoMWPgE9dwv.AG');
INSERT INTO public."USUARIO" VALUES (1390, 'Maxwell Gordeev', '(19) 94652-8909', 'maxwell@gmail.com', 3, 0, '20072045885', '509.605.965-00', false, '$2y$10$wxyIO020U0wR8dWO.X3OX.FXA8.U.39mAYEh8fmHSL3vDOgCMroky');
INSERT INTO public."USUARIO" VALUES (1395, 'Logan Bolotov', '(75) 94318-5732', 'logan@gmail.com', 3, 0, '20133775584', '108.981.779-79', false, '$2y$10$9ItPm2WPMi9WRAg706QSbu5xac3HNm58Xa70R/nOHNFvfJXbwBtQe');
INSERT INTO public."USUARIO" VALUES (1396, 'Stefano Trotsky', '(55) 99649-5562', 'stefano@zoho.com', 3, 0, '20052415345', '909.068.889-72', false, '$2y$10$folw.RSrkWXwVQ4cy5HGoujNEDSwIu7Ecf4mhDK2ZqmcGktXYnHeG');
INSERT INTO public."USUARIO" VALUES (1398, 'Fidel Galagan', '(75) 93882-2240', 'fidel@yahoo.com', 3, 0, '20112848097', '466.496.436-61', false, '$2y$10$/MulmaiQGtrbTqNFEc5GDu.7kNclFS2SpD.QkwyAPeWykOBtssEYe');
INSERT INTO public."USUARIO" VALUES (1399, 'Lane Sushkov', '(84) 98033-4779', 'lane@yahoo.com', 3, 0, '20042184072', '522.717.499-72', false, '$2y$10$rnsdtmCUHJoh59N42vl/JOGSHmR.l8fP0HQKvhCVem3mFa9kcEoXW');


                                                                                                                                                                                                                                                                                                                                                                                                                                                                            restore.sql                                                                                         0000600 0004000 0002000 00000007040 13562536246 0015401 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE bikeifs;
--
-- Name: bikeifs; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE bikeifs WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';


ALTER DATABASE bikeifs OWNER TO postgres;

\connect bikeifs

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: ADMINISTRADOR; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2929.dat

--
-- Data for Name: BICICLETA; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2917.dat

--
-- Data for Name: EMAIL; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2927.dat

--
-- Data for Name: FUNCIONARIO; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2921.dat

--
-- Data for Name: REGISTRO; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2925.dat

--
-- Data for Name: REQUISICAO; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2930.dat

--
-- Data for Name: SAIDA; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2923.dat

--
-- Data for Name: TagRFID; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2919.dat

--
-- Data for Name: USUARIO; Type: TABLE DATA; Schema: public; Owner: postgres
--

\i $$PATH$$/2915.dat

--
-- Name: ADMINISTRADOR_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."ADMINISTRADOR_id_seq"', 4, true);


--
-- Name: BICICLETA_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."BICICLETA_id_seq"', 606, true);


--
-- Name: EMAIL_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."EMAIL_id_seq"', 1, false);


--
-- Name: FUNCIONARIO_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."FUNCIONARIO_id_seq"', 1, true);


--
-- Name: REGISTRO_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."REGISTRO_id_seq"', 17, true);


--
-- Name: REQUISICAO_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."REQUISICAO_id_seq"', 4, true);


--
-- Name: SAIDA_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."SAIDA_id_seq"', 22, true);


--
-- Name: TagRFID_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."TagRFID_id_seq"', 159, true);


--
-- Name: USUARIO_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."USUARIO_id_seq"', 1400, true);


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
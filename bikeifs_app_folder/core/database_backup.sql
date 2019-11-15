PGDMP         6            
    w            bikeifs    11.5    11.5 R    v           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            w           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            x           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            y           1262    16393    bikeifs    DATABASE     �   CREATE DATABASE bikeifs WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE bikeifs;
             postgres    false            �            1259    16658    ADMINISTRADOR    TABLE     �   CREATE TABLE public."ADMINISTRADOR" (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    cpf character varying(255) NOT NULL,
    senha character varying(255) NOT NULL
);
 #   DROP TABLE public."ADMINISTRADOR";
       public         postgres    false            �            1259    16656    ADMINISTRADOR_id_seq    SEQUENCE     �   CREATE SEQUENCE public."ADMINISTRADOR_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public."ADMINISTRADOR_id_seq";
       public       postgres    false    211            z           0    0    ADMINISTRADOR_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public."ADMINISTRADOR_id_seq" OWNED BY public."ADMINISTRADOR".id;
            public       postgres    false    210            �            1259    16554 	   BICICLETA    TABLE     g  CREATE TABLE public."BICICLETA" (
    id integer NOT NULL,
    cores character varying(255) NOT NULL,
    modelo integer NOT NULL,
    marca character varying(25),
    obs character varying(255),
    aro integer NOT NULL,
    situacao integer DEFAULT 0,
    id_usuario integer NOT NULL,
    foto_url character varying(255),
    verificada boolean NOT NULL
);
    DROP TABLE public."BICICLETA";
       public         postgres    false            �            1259    16552    BICICLETA_id_seq    SEQUENCE     �   CREATE SEQUENCE public."BICICLETA_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public."BICICLETA_id_seq";
       public       postgres    false    199            {           0    0    BICICLETA_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public."BICICLETA_id_seq" OWNED BY public."BICICLETA".id;
            public       postgres    false    198            �            1259    16637    EMAIL    TABLE     #  CREATE TABLE public."EMAIL" (
    id integer NOT NULL,
    hora timestamp without time zone NOT NULL,
    remetente character varying(255) NOT NULL,
    assunto character varying(255) NOT NULL,
    corpo text NOT NULL,
    id_funcionario integer NOT NULL,
    id_usuario integer NOT NULL
);
    DROP TABLE public."EMAIL";
       public         postgres    false            �            1259    16635    EMAIL_id_seq    SEQUENCE     �   CREATE SEQUENCE public."EMAIL_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public."EMAIL_id_seq";
       public       postgres    false    209            |           0    0    EMAIL_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public."EMAIL_id_seq" OWNED BY public."EMAIL".id;
            public       postgres    false    208            �            1259    16586    FUNCIONARIO    TABLE     #  CREATE TABLE public."FUNCIONARIO" (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255),
    telefone character varying(255),
    cpf character varying(50) NOT NULL,
    situacao integer DEFAULT 0,
    senha character varying(255) NOT NULL
);
 !   DROP TABLE public."FUNCIONARIO";
       public         postgres    false            �            1259    16584    FUNCIONARIO_id_seq    SEQUENCE     �   CREATE SEQUENCE public."FUNCIONARIO_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public."FUNCIONARIO_id_seq";
       public       postgres    false    203            }           0    0    FUNCIONARIO_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public."FUNCIONARIO_id_seq" OWNED BY public."FUNCIONARIO".id;
            public       postgres    false    202            �            1259    16614    REGISTRO    TABLE       CREATE TABLE public."REGISTRO" (
    id integer NOT NULL,
    data_hora timestamp without time zone NOT NULL,
    obs character varying(255),
    num_trava integer,
    id_bicicleta integer NOT NULL,
    id_funcionario integer NOT NULL,
    id_saida integer
);
    DROP TABLE public."REGISTRO";
       public         postgres    false            �            1259    16612    REGISTRO_id_seq    SEQUENCE     �   CREATE SEQUENCE public."REGISTRO_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public."REGISTRO_id_seq";
       public       postgres    false    207            ~           0    0    REGISTRO_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public."REGISTRO_id_seq" OWNED BY public."REGISTRO".id;
            public       postgres    false    206            �            1259    16673 
   REQUISICAO    TABLE     �   CREATE TABLE public."REQUISICAO" (
    atendida boolean DEFAULT false NOT NULL,
    data_hora timestamp without time zone NOT NULL,
    id_bicicleta integer NOT NULL,
    id_funcionario integer,
    id integer NOT NULL
);
     DROP TABLE public."REQUISICAO";
       public         postgres    false            �            1259    16689    REQUISICAO_id_seq    SEQUENCE     �   CREATE SEQUENCE public."REQUISICAO_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public."REQUISICAO_id_seq";
       public       postgres    false    212                       0    0    REQUISICAO_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public."REQUISICAO_id_seq" OWNED BY public."REQUISICAO".id;
            public       postgres    false    213            �            1259    16600    SAIDA    TABLE     �   CREATE TABLE public."SAIDA" (
    id integer NOT NULL,
    data_hora timestamp without time zone DEFAULT now(),
    obs character varying(255),
    id_funcionario integer NOT NULL
);
    DROP TABLE public."SAIDA";
       public         postgres    false            �            1259    16598    SAIDA_id_seq    SEQUENCE     �   CREATE SEQUENCE public."SAIDA_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public."SAIDA_id_seq";
       public       postgres    false    205            �           0    0    SAIDA_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public."SAIDA_id_seq" OWNED BY public."SAIDA".id;
            public       postgres    false    204            �            1259    16571    TagRFID    TABLE     �   CREATE TABLE public."TagRFID" (
    id integer NOT NULL,
    codigo character varying(25) NOT NULL,
    id_bicicleta integer NOT NULL
);
    DROP TABLE public."TagRFID";
       public         postgres    false            �            1259    16569    TagRFID_id_seq    SEQUENCE     �   CREATE SEQUENCE public."TagRFID_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public."TagRFID_id_seq";
       public       postgres    false    201            �           0    0    TagRFID_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public."TagRFID_id_seq" OWNED BY public."TagRFID".id;
            public       postgres    false    200            �            1259    16535    USUARIO    TABLE     �  CREATE TABLE public."USUARIO" (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    telefone character varying(255),
    email character varying(255),
    tipo integer NOT NULL,
    situacao integer DEFAULT 0,
    matricula character varying(20),
    cpf character varying(50) NOT NULL,
    perfil_privado boolean DEFAULT false NOT NULL,
    senha character varying(255) NOT NULL
);
    DROP TABLE public."USUARIO";
       public         postgres    false            �            1259    16533    USUARIO_id_seq    SEQUENCE     �   CREATE SEQUENCE public."USUARIO_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public."USUARIO_id_seq";
       public       postgres    false    197            �           0    0    USUARIO_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public."USUARIO_id_seq" OWNED BY public."USUARIO".id;
            public       postgres    false    196            �
           2604    16661    ADMINISTRADOR id    DEFAULT     x   ALTER TABLE ONLY public."ADMINISTRADOR" ALTER COLUMN id SET DEFAULT nextval('public."ADMINISTRADOR_id_seq"'::regclass);
 A   ALTER TABLE public."ADMINISTRADOR" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    210    211    211            �
           2604    16557    BICICLETA id    DEFAULT     p   ALTER TABLE ONLY public."BICICLETA" ALTER COLUMN id SET DEFAULT nextval('public."BICICLETA_id_seq"'::regclass);
 =   ALTER TABLE public."BICICLETA" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    198    199    199            �
           2604    16640    EMAIL id    DEFAULT     h   ALTER TABLE ONLY public."EMAIL" ALTER COLUMN id SET DEFAULT nextval('public."EMAIL_id_seq"'::regclass);
 9   ALTER TABLE public."EMAIL" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    208    209    209            �
           2604    16589    FUNCIONARIO id    DEFAULT     t   ALTER TABLE ONLY public."FUNCIONARIO" ALTER COLUMN id SET DEFAULT nextval('public."FUNCIONARIO_id_seq"'::regclass);
 ?   ALTER TABLE public."FUNCIONARIO" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    203    202    203            �
           2604    16617    REGISTRO id    DEFAULT     n   ALTER TABLE ONLY public."REGISTRO" ALTER COLUMN id SET DEFAULT nextval('public."REGISTRO_id_seq"'::regclass);
 <   ALTER TABLE public."REGISTRO" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    207    206    207            �
           2604    16691    REQUISICAO id    DEFAULT     r   ALTER TABLE ONLY public."REQUISICAO" ALTER COLUMN id SET DEFAULT nextval('public."REQUISICAO_id_seq"'::regclass);
 >   ALTER TABLE public."REQUISICAO" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    213    212            �
           2604    16603    SAIDA id    DEFAULT     h   ALTER TABLE ONLY public."SAIDA" ALTER COLUMN id SET DEFAULT nextval('public."SAIDA_id_seq"'::regclass);
 9   ALTER TABLE public."SAIDA" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    205    204    205            �
           2604    16574 
   TagRFID id    DEFAULT     l   ALTER TABLE ONLY public."TagRFID" ALTER COLUMN id SET DEFAULT nextval('public."TagRFID_id_seq"'::regclass);
 ;   ALTER TABLE public."TagRFID" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    201    200    201            �
           2604    16538 
   USUARIO id    DEFAULT     l   ALTER TABLE ONLY public."USUARIO" ALTER COLUMN id SET DEFAULT nextval('public."USUARIO_id_seq"'::regclass);
 ;   ALTER TABLE public."USUARIO" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    196    197    197            q          0    16658    ADMINISTRADOR 
   TABLE DATA               F   COPY public."ADMINISTRADOR" (id, nome, email, cpf, senha) FROM stdin;
    public       postgres    false    211   `       e          0    16554 	   BICICLETA 
   TABLE DATA               u   COPY public."BICICLETA" (id, cores, modelo, marca, obs, aro, situacao, id_usuario, foto_url, verificada) FROM stdin;
    public       postgres    false    199   �`       o          0    16637    EMAIL 
   TABLE DATA               b   COPY public."EMAIL" (id, hora, remetente, assunto, corpo, id_funcionario, id_usuario) FROM stdin;
    public       postgres    false    209   A�       i          0    16586    FUNCIONARIO 
   TABLE DATA               X   COPY public."FUNCIONARIO" (id, nome, email, telefone, cpf, situacao, senha) FROM stdin;
    public       postgres    false    203   ^�       m          0    16614    REGISTRO 
   TABLE DATA               k   COPY public."REGISTRO" (id, data_hora, obs, num_trava, id_bicicleta, id_funcionario, id_saida) FROM stdin;
    public       postgres    false    207   �       r          0    16673 
   REQUISICAO 
   TABLE DATA               ]   COPY public."REQUISICAO" (atendida, data_hora, id_bicicleta, id_funcionario, id) FROM stdin;
    public       postgres    false    212   ͙       k          0    16600    SAIDA 
   TABLE DATA               E   COPY public."SAIDA" (id, data_hora, obs, id_funcionario) FROM stdin;
    public       postgres    false    205   O�       g          0    16571    TagRFID 
   TABLE DATA               =   COPY public."TagRFID" (id, codigo, id_bicicleta) FROM stdin;
    public       postgres    false    201   �       c          0    16535    USUARIO 
   TABLE DATA               u   COPY public."USUARIO" (id, nome, telefone, email, tipo, situacao, matricula, cpf, perfil_privado, senha) FROM stdin;
    public       postgres    false    197   ��       �           0    0    ADMINISTRADOR_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public."ADMINISTRADOR_id_seq"', 5, true);
            public       postgres    false    210            �           0    0    BICICLETA_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public."BICICLETA_id_seq"', 1178, true);
            public       postgres    false    198            �           0    0    EMAIL_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."EMAIL_id_seq"', 1, false);
            public       postgres    false    208            �           0    0    FUNCIONARIO_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."FUNCIONARIO_id_seq"', 1, true);
            public       postgres    false    202            �           0    0    REGISTRO_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."REGISTRO_id_seq"', 19, true);
            public       postgres    false    206            �           0    0    REQUISICAO_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."REQUISICAO_id_seq"', 10, true);
            public       postgres    false    213            �           0    0    SAIDA_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public."SAIDA_id_seq"', 22, true);
            public       postgres    false    204            �           0    0    TagRFID_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."TagRFID_id_seq"', 289, true);
            public       postgres    false    200            �           0    0    USUARIO_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public."USUARIO_id_seq"', 1968, true);
            public       postgres    false    196            �
           2606    16672 )   ADMINISTRADOR ADMINISTRADOR_documento_key 
   CONSTRAINT     g   ALTER TABLE ONLY public."ADMINISTRADOR"
    ADD CONSTRAINT "ADMINISTRADOR_documento_key" UNIQUE (cpf);
 W   ALTER TABLE ONLY public."ADMINISTRADOR" DROP CONSTRAINT "ADMINISTRADOR_documento_key";
       public         postgres    false    211            �
           2606    16668 %   ADMINISTRADOR ADMINISTRADOR_email_key 
   CONSTRAINT     e   ALTER TABLE ONLY public."ADMINISTRADOR"
    ADD CONSTRAINT "ADMINISTRADOR_email_key" UNIQUE (email);
 S   ALTER TABLE ONLY public."ADMINISTRADOR" DROP CONSTRAINT "ADMINISTRADOR_email_key";
       public         postgres    false    211            �
           2606    16666     ADMINISTRADOR ADMINISTRADOR_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public."ADMINISTRADOR"
    ADD CONSTRAINT "ADMINISTRADOR_pkey" PRIMARY KEY (id);
 N   ALTER TABLE ONLY public."ADMINISTRADOR" DROP CONSTRAINT "ADMINISTRADOR_pkey";
       public         postgres    false    211            �
           2606    16563    BICICLETA BICICLETA_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public."BICICLETA"
    ADD CONSTRAINT "BICICLETA_pkey" PRIMARY KEY (id);
 F   ALTER TABLE ONLY public."BICICLETA" DROP CONSTRAINT "BICICLETA_pkey";
       public         postgres    false    199            �
           2606    16645    EMAIL EMAIL_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."EMAIL"
    ADD CONSTRAINT "EMAIL_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."EMAIL" DROP CONSTRAINT "EMAIL_pkey";
       public         postgres    false    209            �
           2606    16597    FUNCIONARIO FUNCIONARIO_cpf_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public."FUNCIONARIO"
    ADD CONSTRAINT "FUNCIONARIO_cpf_key" UNIQUE (cpf);
 M   ALTER TABLE ONLY public."FUNCIONARIO" DROP CONSTRAINT "FUNCIONARIO_cpf_key";
       public         postgres    false    203            �
           2606    16595    FUNCIONARIO FUNCIONARIO_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public."FUNCIONARIO"
    ADD CONSTRAINT "FUNCIONARIO_pkey" PRIMARY KEY (id);
 J   ALTER TABLE ONLY public."FUNCIONARIO" DROP CONSTRAINT "FUNCIONARIO_pkey";
       public         postgres    false    203            �
           2606    16619    REGISTRO REGISTRO_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public."REGISTRO"
    ADD CONSTRAINT "REGISTRO_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public."REGISTRO" DROP CONSTRAINT "REGISTRO_pkey";
       public         postgres    false    207            �
           2606    16693    REQUISICAO REQUISICAO_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public."REQUISICAO"
    ADD CONSTRAINT "REQUISICAO_pkey" PRIMARY KEY (id);
 H   ALTER TABLE ONLY public."REQUISICAO" DROP CONSTRAINT "REQUISICAO_pkey";
       public         postgres    false    212            �
           2606    16606    SAIDA SAIDA_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."SAIDA"
    ADD CONSTRAINT "SAIDA_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."SAIDA" DROP CONSTRAINT "SAIDA_pkey";
       public         postgres    false    205            �
           2606    16578    TagRFID TagRFID_codigo_key 
   CONSTRAINT     [   ALTER TABLE ONLY public."TagRFID"
    ADD CONSTRAINT "TagRFID_codigo_key" UNIQUE (codigo);
 H   ALTER TABLE ONLY public."TagRFID" DROP CONSTRAINT "TagRFID_codigo_key";
       public         postgres    false    201            �
           2606    16576    TagRFID TagRFID_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public."TagRFID"
    ADD CONSTRAINT "TagRFID_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public."TagRFID" DROP CONSTRAINT "TagRFID_pkey";
       public         postgres    false    201            �
           2606    16551    USUARIO USUARIO_cpf_key 
   CONSTRAINT     U   ALTER TABLE ONLY public."USUARIO"
    ADD CONSTRAINT "USUARIO_cpf_key" UNIQUE (cpf);
 E   ALTER TABLE ONLY public."USUARIO" DROP CONSTRAINT "USUARIO_cpf_key";
       public         postgres    false    197            �
           2606    16547    USUARIO USUARIO_email_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public."USUARIO"
    ADD CONSTRAINT "USUARIO_email_key" UNIQUE (email);
 G   ALTER TABLE ONLY public."USUARIO" DROP CONSTRAINT "USUARIO_email_key";
       public         postgres    false    197            �
           2606    16549    USUARIO USUARIO_matricula_key 
   CONSTRAINT     a   ALTER TABLE ONLY public."USUARIO"
    ADD CONSTRAINT "USUARIO_matricula_key" UNIQUE (matricula);
 K   ALTER TABLE ONLY public."USUARIO" DROP CONSTRAINT "USUARIO_matricula_key";
       public         postgres    false    197            �
           2606    16545    USUARIO USUARIO_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public."USUARIO"
    ADD CONSTRAINT "USUARIO_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public."USUARIO" DROP CONSTRAINT "USUARIO_pkey";
       public         postgres    false    197            �
           2606    16564 #   BICICLETA BICICLETA_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."BICICLETA"
    ADD CONSTRAINT "BICICLETA_id_usuario_fkey" FOREIGN KEY (id_usuario) REFERENCES public."USUARIO"(id);
 Q   ALTER TABLE ONLY public."BICICLETA" DROP CONSTRAINT "BICICLETA_id_usuario_fkey";
       public       postgres    false    2760    197    199            �
           2606    16646    EMAIL EMAIL_id_funcionario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."EMAIL"
    ADD CONSTRAINT "EMAIL_id_funcionario_fkey" FOREIGN KEY (id_funcionario) REFERENCES public."FUNCIONARIO"(id);
 M   ALTER TABLE ONLY public."EMAIL" DROP CONSTRAINT "EMAIL_id_funcionario_fkey";
       public       postgres    false    2770    203    209            �
           2606    16651    EMAIL EMAIL_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."EMAIL"
    ADD CONSTRAINT "EMAIL_id_usuario_fkey" FOREIGN KEY (id_usuario) REFERENCES public."USUARIO"(id);
 I   ALTER TABLE ONLY public."EMAIL" DROP CONSTRAINT "EMAIL_id_usuario_fkey";
       public       postgres    false    2760    209    197            �
           2606    16620 #   REGISTRO REGISTRO_id_bicicleta_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."REGISTRO"
    ADD CONSTRAINT "REGISTRO_id_bicicleta_fkey" FOREIGN KEY (id_bicicleta) REFERENCES public."BICICLETA"(id);
 Q   ALTER TABLE ONLY public."REGISTRO" DROP CONSTRAINT "REGISTRO_id_bicicleta_fkey";
       public       postgres    false    207    199    2762            �
           2606    16625 %   REGISTRO REGISTRO_id_funcionario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."REGISTRO"
    ADD CONSTRAINT "REGISTRO_id_funcionario_fkey" FOREIGN KEY (id_funcionario) REFERENCES public."FUNCIONARIO"(id);
 S   ALTER TABLE ONLY public."REGISTRO" DROP CONSTRAINT "REGISTRO_id_funcionario_fkey";
       public       postgres    false    203    2770    207            �
           2606    16630    REGISTRO REGISTRO_id_saida_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."REGISTRO"
    ADD CONSTRAINT "REGISTRO_id_saida_fkey" FOREIGN KEY (id_saida) REFERENCES public."SAIDA"(id);
 M   ALTER TABLE ONLY public."REGISTRO" DROP CONSTRAINT "REGISTRO_id_saida_fkey";
       public       postgres    false    2772    207    205            �
           2606    16607    SAIDA SAIDA_id_funcionario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."SAIDA"
    ADD CONSTRAINT "SAIDA_id_funcionario_fkey" FOREIGN KEY (id_funcionario) REFERENCES public."FUNCIONARIO"(id);
 M   ALTER TABLE ONLY public."SAIDA" DROP CONSTRAINT "SAIDA_id_funcionario_fkey";
       public       postgres    false    2770    203    205            �
           2606    16579 !   TagRFID TagRFID_id_bicicleta_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."TagRFID"
    ADD CONSTRAINT "TagRFID_id_bicicleta_fkey" FOREIGN KEY (id_bicicleta) REFERENCES public."BICICLETA"(id);
 O   ALTER TABLE ONLY public."TagRFID" DROP CONSTRAINT "TagRFID_id_bicicleta_fkey";
       public       postgres    false    2762    201    199            q   �   x�M�MO�0 ��s����T>v[uª�,&��u�c�_�<�x|��E]t6-�������W�-���n
C��C�/"�89u���8�K�=���ƌ2���|����r}�������͙�����Y�v�+el*�T�L�Iї��ݠAu��|:�j=�����_`��'�޿ �����gL��e�+6���7�j�L�����˦�����e� ��K�      e      x�՝�ΜGv��9W�������Z��=J� |�����M��$��&��6��R-������j�Mv[M0F�߮j�j=��~~�ӛ׿�����{���7����~���o~���8��7����V������<�7��}>����'�>�g:��)~�e�{��'�����W�*��w���Oz�����������?�ʸW�~�O���?�v~���߶���/ox���W��ǿ|�����?��������������	����?}�㻷�}�������y�˷~�޾�������~\� /����[����>���_���S߄��x��4�4�3����«�������o�~���۟~���xq�������O�x��x����"�)b=��+�O^�o�'��7�����??�����/ߍK<�y���o�қq��޽y��������>���wo߽���/O?����'�|���?����q?�>�����ƿx���o�y��?�<��qMy(��<ϕ�1��������
�PV^�|f�i��m9�7/>�o�?o�������g�y�˛w�>������NTZ[�����q�����߶��{����*��r	dK��8��Gӯ��w��>�b�\Y�&�j�5�E���5B����%>��(w��z	�v͚4}`{��\�#�&)�lm�<�ˏ!�_�b�d������}����X���5Ko[Z�Fn����BW�h-[��k{�����!�S#�CW��k��ĭMk�\�~ĞĞ��S��W�/$�� Ɔ���M�srjzD:}�����Y;o��$�}Ϟi��y�Tk���D&�v���Rh��6hO}�M\t�P	�&c1)�W�$>���b
b
}�.N�UYՇ����댘i��iV�}>>�VMw�۴�� [a�h�hϘ>.��ix��)f� f��nu���}.q"q"d5g���r#�z����ח�sa�7f����4��VF�a���n�Hz`�=rg�1�����ާG_�|�~q�
��bΕ$�$^�"^؇�¹�o�g�-g�E���TV�ܾxx�xx��)��k���O�#N�"Nq��ޭ� ŪB������ܪ��-��n�㓺k���˴�ˬ4bD�x�>��z��gg�����ފ[��[4�e�������k��{��l�O�O���WFȫ�A�*��"�^��ƊZ�q*������x!����H�t�͛����Mp}UHH�r�br��.$�LL�C�U�����Tm�
b��f�d��^�̉1u�1Uد�W������I/�aw����:�����>=n���Lz�Lz��c�u��Ȏ��b��YV�N+�Nl�Gr	^�et�G�,C��եe�s'�G�9�U�.���5-��#�?R�i�"{�y譶`-�j�ꭊ��H����Ԯ+d/%I�G�Z��?z�IA���?�<�A��d�Ƒ�Ö�U��\���KV�/M}x��X�#��-���!Q],\}�j��6=�6{!�)Pa�6C�v�"�{-J/��#�7t3���f��?�������\p��g�J�*.��څ0��]����3JZ-��mel��㔖��>�Y�c�R��ح���:�e����֋����Z9?����38/�+ ������OF�l�̬��$��7��,N3�ɷ���,~% ~��}�=��ns�*N��8��8'O#�n7,y���g�g�e�)x��`Nw��b����q�A�H@��p����
��ͮO���+�(�~l�8�j3U;�x�{���;����"��9�4�x��N�ۅ�w8��U"�s)�L�e/,X�:W���qq\�:�>����e�m�^/��P[TůzM�:�r�f�/��+ﰞ�;E�;��1߾e��,vO�bfR%���B��c��J�o[�w߄��~.>�	%��ij�ZVF���>�_��2?B<�;�����Ӂ��5�0��&� �f,�9��u�ŠbPM׮����aW�v���-����4��)Vj�U�D+Q�;!�=v��Qk�Q�9!Ɯr���jڦD�:Y��#��Tv|�$֙�<���lgF�oiP��Pڬb��O*���+'�'ط�/�Iuݑ$�$1WOf�2ߣ�O��0�q�L�]*��8F�����UH8�<�#k�e��'~�[��q���i��Ė3V��#�YV4٣���F֟�h�v=�qgĸ�ҩ�m�5i�]�!Cw���s���U�O��l��m�-���I��*	J����K��˦���Ŝ2Dʕ��\�w>c��1�
1���015�a��Z�e'7�jZ�_����Y�A,��녃%؊q��G2�6�RSU���I&���Q.줳;�Ҧ�K�{�1�)���Pc�M��c<j��,��&r�3�A>�k���'�Jɕ��UuUi��ط�]
��v�J�S"�kd7-�fc*�k�:�BE{��n�[=��;QL�̃�.BC{��6��N�;�ҍ�[�w�m�>>�BC{��.��j�	�W�6����僞�� �B�;'��j�?罉��P�d�^��[�X ]+%^�V뗞�

�!:�yG?b�k��|�K�l.B����/+�´���'d/4>�b�6�_J�mq�&��<E�t{YF����C�w��>ֹ�<���b�!>��'�\ϻ����r+\�7�e�ś�e��lv��9���(A��>^ʬ4P��n%>���cx/��g᥸>�.�TA,6�2V���t�c��̺���&=+��������V�5�/w���0�!`8Z�h��{�_OK��_��x=�{=�~�B���'��l�	{�UϹ�&��_�%�3���z���{�������f7x7� خ������gK#4��|T(Ю��XU�H���C�z~�x����C,mT-�����
��!�l���}z	� R֘ZܪO�ۖ֧[Uo�B��T8Yq���W驏��{W�,��Zaj=�Ԏ{�j�S0kW�n/�t�z|M����9G���z�_��B��#Z<��,mu�l輦Gz¼���5�w=[+6bP�NU�s�g�E	<!ش�**�x|���a�Q���U+(�w��7qd8i���S�;��vj�����5���I_�a��;���R�SxИm�3&�N|� �ҵYe�0�)����NO�a���&�~� [��XMV�lܲO�'��{	�ĹM�s�êDZa�=�7	�R��
��!�WW�*8&kw���̢��������-�˅U��%�����$,�Pd�5��=l+�B�C�r�&�]��DB2{�d6��:���ʱ��l=j�/$��H������Cy�=ħVr����1ՓF��{�B�z����b��FM�P3��c^v���	5�!j��^�J]��;�V���^��_�;�*^
�nK-������XFй��LO�i���Bo���g�Z��I`!�#�����6����M��'�/1�|P)SM^q�q�������[S֬��|8z����o��B7���r��3�e�a$�F��z�]�>���C�3'��ļ�Vkͷ<9{���BTs(#7��j���"�ؕZ����� ���9Pc۵�s�w9���Ctun=Y;��F%_y4u���5�U��f$��w!���[�ή(�V]�����cXR�g�+4��h�L�����V�l1�ilw=P�6jn.�X��=I�J������+7�vma�=�2��C[��f3v8r�ᜮikL�C����ª�P���K���D��n�sD���Q�w������(vÜcKy��OQ�iO�Y19�b��jcٙ\�����u_�VD�k��:)���"��uQO� ����W�+8�!p�3�|U���Bbq!F،d"���L��`'$�K4ˤ�1S(aq�����y�9k��P�:��]~:�^��"d#���܂�z��ܬ_r��[v0T��>����ږ��H�#��A�n)�\c!�<U[��r���*1猘sG/�e�p�K�� @�=��'��3��k1�+SN���5t�n"�i    �ZC�gT��N���		�� �����.;��a�Ό�f!��'bZU6�X�`��J����n�A�dJ�&����쌍�~ u�V�کe>�O2vSD�t��|[�$[�*Ǧ�ڜc�NA��v����RKXP7R͞/��|к��fD���#_��)ނ��9�/�<zP�n�FR@�1�&�:=p!���-9�������7��9�jme��Cߖ�wN
 "��!٭������r��gI��ZjO<��/)���U�wɥ�@�	�녑��ދ,��d���V=ǥ�D`i�Ըn��Ϩ3+�D&)���p5��3�a�֣p�9�����\x����;1�SY��<�Md�e3�o��{�ew�%#
GR8Rٴ�z�
�%(i�*�L���M��ՌK6�09����r4TnI��]f^���c�����=V~�[B�7٧�i�W=bnEF*`2R�e���(�v�	�t��-�O�����G]��}w�i�dT�$�اF� ��ͺ�exĥ�D�*�E:������t'ќ��t�; ?zw��0m���-��V�<���a��St�� u'���N�'"JQJݼ>����VL3���|�vwʪaC5�v?l��D�)@Eը։�������ӯ�mNmP_ok�L�[���f�)��>�xH����z��7N7�H:H�)W��΋]aE�)@�I**��NB���� �G�t�����jB����?L]��8)H5*7g��(}$����KG)�Q:Eʡ�?y�CMg��t1�f�1�h�c�bX�x_�^�L�=�(AH	J���z�\e'bP� ��7��,�RǪr������}H��Q�ԛJ��JuS!,]�;��7$zP�SҊ��֜GJ�UO;�p�?����� )=Uk�YΝe�"&v2|?����>�7H1�T�g��/}���B�N�}(|ںv�u���������ﺑ�wr
 ���9^�n��1�9�z�gW��jHq*��e������h[H۪���r������C_��@����r}�,x�%� )Q��(����KL]*��]��?�8&Heʥ���{E��OD)�/ })���a:�1� u YRJ_�s���ܡl�^d����_u��V��*�l0XN�-+ig�� H)����>M͇���}����B��DH&�{U��Z��&E�-��U���"I@I�;L��d����E��e��CQ�u/[o��Z�$��]�q���p�j~�{7r�� �%U�Z��ʬ��;_-s��x�# �XE�JD���L�趟S���[�����ͷ��He��P��Ϊ�����+�xYq'�Rt�#V2������}-�=�gZIm=F��b�.�/4�!=� �$��K1���Ƣ��i�A�n&ϒM�r�c��;���N�|k+�^�� �������N�� �X��YM���J�sT�M7�hPH���\r��I�� �M5{_����*k��.'����x�� (]"Ϛ��[|�㓋ׂ���Ț�Tbl�\�b(��f"�IBjPtМ������g�آ� �#���k�N�N��$,��eVm�٦1o�l����(�U� �i��qH�Y����]�}-��	���z��CjA��'w�G1�P��]4z��c&�wB�h���Q�>�ГBz�w~A��$w��i�;W�ќ���h��1�j12<Q�sޟX;H-'_jy:q3���DqbJ�����W��K���M;��;d�"U �3ld_��#.�<�J6�eP��휢� ��iՖQ��e�p�y}�|?q�w��lHtG��i嘴q��@�g��,�M"� y�B:���)���Z����Ԣ� ���T�S�R�k��"~(�=R�i��y6�Q�1;�1֐��19����X�;8�y	�>n���H�f��C��[�v�'\Ry�����â�y&�5��N`� � �W#�_�����:�ź��^!��4"R�dK�f똃�kA�L���)�|PW,jMRk�9>3s�&صB�q}�+��䛺����y���H�ȸd�$�GICx��w���� ��G�ۧN��{�ӛ�=��N��b�?氮�Ʊ�e}�4rL;`���n��E[�-v�޹���'��N�1��н��K��Hz�*�χ���^��� :@ tw:����rV�̐�sOB?G����p�,y�#�jx]W.�&��ԢY6rZ�Ոb�:�w' w�@n�&��6���rw�����M�Ļ�����nK�y:e��s��M���W�8�0m��cN
��/岐ޗ��է� �1�9��M���ǐ$�W���c���sr�nY��[/�p����R�U1�t��y`�҅>��m^����-���$���?o8�:B0�Շ����]��p�a��:BH��\�>��V�����9YVB=m�[T^����D�Gte^����*�����L�����`w�M/�/Tr���m1�u(a�0�L�`��83���>���bFLyU�����:�uc/��5ՠd!ȸU��'���P���B�m.�l�m��S�Z/�gFPx!�#D<k�BZ��4}�� ��s�K�vM녨�Qmcγte"uS���b�e��hbq�6�7��N��#��g�T��d����ڼ&��0�X�X�:��jo$8�H�����bp���F��10��g����f���G�(v�0��S*���TA��f�k�Y����!dۥ�����v.{JkĈNb"�#��k}ϫ���}��gU��������1�[��V��a|;(uqYB����;B����\�C������{�T��/~L,1D2����<�����
���f-g��y��#G;r�2�t����s�眓b3�=���ĈB,��y$)�	[�9:��+TH��Б��SebSa#�UX�����d���x���b�sk�W�-�R-"ؖ�^k�3ى��1�U	�)��GUx�!ֹg���sd�k8Wڇ�`�/fK���xC�sU*���*����F噖9�Êx��#�MW�HOm��k��Kd_�3HG�if��}��G'��d�r�p�B5G�j֜ԔϏ=e���j�@���s����O�ŀ-��6�/�z�Yp�����6k�F�Ծ�nN����B�i��T�����%�&V/�p�0�ͪ�֙��?�M��0�b|��c[K�W/mW7B ����A?'S�����!2V��,�"�f���E��+��4�����]��P��R�sj��UǄq�~=4��&�>�-�`m���8�{�XDɗu�K'�Z�1�Y�JfN9����Cȩi�����~L���v��/�4cP�ub�,��{H�y/��wI���n��`��.���=
�!��]гʹB��1����W���Ɂͪ�s�eKϋ� �BX��lù��헐`bV}v����Pk��L6�x�_x��72�:�|���u�c��M���56~W��/#1d�Hή ��Z`��(W��,�u�`'T>����鷵�~���*ZAbȨ�hfo/��9�ޫ����.�J0�a����$�](��X��J�TXw[N�1�!���u���6�C0idG��f�]F�15̱�����.���8j��J�!��}��%He�X;�K����7-��^��ɞ#�jSw�f,!B#�Z�����~$���
%��G1wi�Apo>��0�b"M�*LU��,yem�xm�by���rwp3�PF��?�ҹ���<���[[�Z�^����Nk�'}�{�zA#�0�V�����1���!^1W�_���/ƫ�d�Fh����y���*6w��2z5B�pX��º1:cN�ES����έ! #D@jU�Z\[VW�����C�aϡ��;5帧��m^� ^�p1u�ZѸ���\�N�sn�,rw�����S_ggĸ������v�گ����6p��oF�bZ.�$��:ײ21&�/�1�ڄ�c�﷔Y�4�n�r    Z�x���&�V)����C�<�H�hٸj���hp��$\�%�pk"�H�C���b�l�g��S��ۃ���M�*���P�i?����`��}#X�eV������}�wv�7����:��tg�oZ�?{���9��P���m�dCw�����k%�=dE��}�� �"a��J���/���kZ��Ƿ����yJqyC�om:�J��N��a��� ����螇@�S�UK�8��/�v4�8L�~�}H%��E���kCo���뢥�@�A��Tӧz�ù�v�0�1�-�N<Wn�>XJX�Chq9눜��
_ͽ���a��R/!�>���j��uz>%>o�7����,5q[9J�Q^���q[������9_"��yŹ�b�i���(���ȶC��&հӇ=�_��CB{�Dᦫ�n�B�Y���<��4�����}T��`�����W��*f����ޚ6�z�=f�^	^UW4��T���v��!]� ��MN&��N������ �U�D~�9+�[�g�t	I� �4�6���Z�����kZ5�hO�*qYi�σ�����(�xͻ�.d73�D�!)�?�B�B h��ܔv���Zݻ�u!N	"Ncj�V9���VL��L+�v~/%*A��L���uD	"Ja�|�m��t��x������B�l�c��N������]c~+���%��n��q���	�J������I�����~�8�`U�mz��G&�D���槇(�f��,����ѹ7�|:qdP�Y祔Nr�609�/�h�0�B�4�7)�z�f� 3y	�n�X5f��STq~�Tܲ��\�K���>kչ݉��������Ȼ�ق	�	k�Y-�P�@�>����$�q�"�	�KJ���\=(*��ʹ�K�ą�L�\�Sfu�-��5�Դ_֮���M���mP�r�綤��:rr���n!�	�C�b๷P�J�*��{gQ��ڢW��1t���NɆ�d��?�z� z�W��^�Յ�&��Nձ_y*�)t�m��̅��=���d�ގ��8	|em*gV��&�B5w�Z����1ā@�t���&݉V�M|�>�s�Z��Fw��JQW�����E'w�5%�2A��p©O�EQs���I��Є���i[����τM��-�=�<:��pa�ƣ�@Pj�fm�R����B��.x�S#��	B�u�.O��w��p��:�!1�����\L��u�*Z��'�f��2��.%�4A�����ժ�l�zZ��,뙹��	����ʳ�hkV_7��xe���p`������ܱ��J��]�ܻXe�6Ʃ85a�$�6A�vg�ft�@n�� �Z�x�S��{��t��	��ʱ�����I1��]Ӳ��F0K�R�A l�F�zwP�{��*b�!̻�����8L90]�퇭m��h5����X�N�/�un_<N�mR�ju6}��4�Aa��o�E2*L7AL7��^Q	=" �0�XӖA�>`��|3q��x�C g� ��\�s����%�ڈ+�3A��[��H��P1yZ��X����M��03��0�f�!PٲKz��Xײ���O�9�E�0fl<i+#�_n��*�x����S/r6'|1C|�5��������Dή��(����P�f݂z�h� `2C�J�����s��?�ݪ{ԨP��2D+oj�"��BM~��s�>
����s�v׻��1-?I��hy*��/����I$�!$�w�z�7��m�QZ�������ҩ&u&ǟ��XUѥ�]ލ{D��(�-C�m�&��4<��X�`��a��@���GÌ�������"�a�1Jok�[z���"AXkR��� ���O	oF�Z�Z�%����W�|�8�(�)C�i�ɘ]_�]V���C���O��~��,�'C$�Q����fs��^���bB�Q�.Z�Д��X6�
Ǽ,����3
R��l}I).#[�	�t-J�x��HFK��Ӹ4�l.y>o�zʔ!j�E
��D�:�W�ܗ������]M� ���7d����f�Q�J���Ѫ�U�Zv��G�h/�^�gڌ;4~��KH�u�Bx�r����ޙx�QS|T��>w�ݣf��d��l)=9��Da(b(S�mΨ�
�u�w&��2e��әM~���d��tл\9e�^�v�f�3˲�;w�b�163�&"=����m��[F�*�F�ӡ�nj?k����#e�(CSG��l�"�=�5��*e�9麊Y���m�4czh�0el�g8����M�
Wb��.vlNr�!r�t�Ҽ]���ߢ �!��uZ6R��aa��c-���ާXXlHi�~w8Uc~L�.v�l���a�>%:��C/�U�As���'Z�E��2��!�2��)g䢣0�1�ZwU���/����:T>�!r/je��/^7Ҍ���(/{��m=A�B�Z�&O���}�W�ߐ'�ċY��oX&NP7�i9�b���có���Su�����89K���1��%Mi��ő��Hʥ��=�^�pkqkq<issT~�0O5��R�Sag�^D?�q1�q+�ư2����H��~G1�h,�u�U8����tOz-i���(Hc��B�h��~Z�!Z��/I�ӗkN%��9M�S�����.��-7��(=7#og:/ߚ#H��eߩ��f�����nMW��$�>�'�����ȹiuZ3g3 :4�!4�����:�<��dBr#%��X�o��u�(,C,]�J��kC���e��z�X-UX"�X"�غ��z�]�#��#W���tC=�s�A�B�(5��O��;K�32D5���ȵn���Cl��g�_\Y�۫ �!�&֖�J@/dj�zƢ.���[��0󨤓����q�L�&�5*�;�D1ٮB��]�¿��)��aR�a*��"׳�B�D���?��\�D!{"{Z	A�� %�d�"^P\�=�$~��nA�QR|��|��\ieW
�����!��3�T/����0���ӂ�Uc���\.~Y;��G�t�t��&�ʿI�&��Kc�n��$��HD*&/�[��ڔ����Tg�A��Pe����-l����v��+�������ه������.d�[���>��b�����,b�,��x=�NtLN��n�����}��e�c^�1��)����Y-����oƟ��̳
�O�h�g�f���X������x��`9�>��B�=��ͮ���Dm]yV+�،I\�D��t-	�3�=Ԛ�<:�h�r��`A��	*���#$�V�լ5�ylfj�rÏy��N��֍k_���p
;�T�����~����~�Mq��<�ʇ�DH��6_�-��7�[,Tf�4K��f�x��σ�*jմ��Dr��ү{X��]Bss�����G���^K\Ժ�����/B\W��̴؇=4����Hm^b���S�Gl���vOoW@�0��Z�&�؞Eo���q&LczH���j`!�y'�3�ֳ���lm����'���%�7�M)�Sy�Mx�,��,���|���Be��ݣ����[�Io��`i)��W�Y��p��~�`DoV"v�r������l�5F�t�B9�hGk��:�\yR��]��_�|�~~�!@����,i�ka����N�l6�[Rvq��2V���3[��#=���|C����l�X�I9�M/�Y*�@1�c�§�J��rE>����������Nfg<ޓ�-��P���-�!�ڎ�ۈ7�?��-��y�Ƶ
:�U3ql�b>R�� /������Qv��
Լ��i4��'��rU�f�V|
���٦?{�����$����{~���@􏧴�~O6t���k�h��Ԃ� C��N_��/dsQĽg5�Jw��n�<�� �$��j>�z��X���5�Z��s0�'W��j�ۮ�6�M_3=D/G�n����F��v�!���q��L34�����m����mV"�BvN���RQ�Y-�r���Zڇ�1ڕ�}�+*|n3h���4e5U;E�� ,  �mfB]zmϢ}�c��o{b]��W����H�0P0��i
��,Ѵz��+��q�B:�N�ln���f���Ad�����l�e6��2h2������L:Q�C�~�����!*Y����{�;Ğ~���mb���6���06�T���G(~!(�� Ji���5K%���-����}Y2�c�Xv(��0.�ϙ��hR���L�q��M�oڇ�Ά�@��
��'WMusKunۆͶcӢ�f�B(qE'�A�s|�G_���1 \�}qay^�K+�.��6�lFs'�^��=my�M��5u� ���uJy�O�y��e3��3S�
�y���L��:�۝!�2��e� )�ڙ>��;� asCVu6s�5�k�͓@�Xr�5�|浶0Ub'�՗��_��_�ʴ����F��U鼯vY���C!n. ��^�y�66��kަ�x��3�%�UK}����Yd��J1%��C�B_�g��/n��B��so6����WFȏѥ�/I2<�ͧ�(A��𸪫[��j3 �E.�V��{�Zj�&�l��O�}keZM�B����Dv���t JM����/30Dx�3,m�BĚ+������mQ$C���7�j,؊��er#O������Z��]�}'uEO$m� �Ȭb�U#����H��q���1-�Cs�t#Ϋ�W�Ly��e�UM˼y2���*�%@lUh�R��M����վ �\$��Q�ݾ5��O#MCL]K���;���ń�lQ b����C�����uk߱�x�\d2��@�v�3r��G�a\q�M��ٟt�ObCT������ӏ�n{����w4�:���NL�1M5oP����ڢ�C�3�}y�44�E:�D-��؆cM(��B.��Y������YS}��Hl���z������qKas�T�I978�)xh��z~a��;�v.-�C�byl���ʻ%��}�8\�����6�jn��J�]	Z�d���4#�xky�PO��y����x��L��
��Vx�c�*���Ǯ�>v�MZ�-C��^�5%�e���sy��P���ȹ��î��aB��M�җ�x[B��Tr\����)޺�5�e��1v7l3[���z�G[��7l}�j{��RZ5Q�ڻ��Fo��Z\�W���#:W��4��0���]���+ޚ�5�$�b���*�ۮ�z�5�S+�<I�r�Y��Y���g���POw���n�ݾ,�[���5������_G[o��j�s^h��./�­�[C-�&Z��E�U6��G�U_���]	�}�u�_��%�-���������ǀyI�A�e��}�Htk�P�����a�K)�R����gu>��bX}#$T� ��w��������|��WO5�j�*T�ˎ�{LH�iZc�j-˭�G�Y1ApSLt˓�]Pޚ�5Ԍ�b�q�h:df�1�(|΋ܲ �����i�dtK�9֖Z�%g��֙���ԑ�d>�x�5�j���V��y��eS�VR�)���ue񚷹a%��X/55O�D�ZI5�JZ,i�tl����S��n��TC=�������K�/%���%P�fﾩ]��?����U���O����?=��_�����wy����_��}����;V��_�������ߟ~z��7O��y�������q'��N�շ?}�㻷�}�������y�˷���7��������Ҋjj�fWCz�.|�"�|x���W����W�_?�{��8y��s��kVj������?�|�����_/~.�����^��o���J%z��8^��O~������6�5      o      x������ � �      i   �   x�3�tI�H�SN�(-.I-�LI��+�)�r�s3s���s9c�8������̍Mu-98U�*UT��|M�����K�R���]\���=����R�R��R+Cr|-�Ӽ+󳼌�B��b���� �&�      m   �   x�m�=r1���:�^`}���CPQReH����1lV̚���Y���W�X ��d%�̨{6�S{�=g�sV��]���y�`js7G��.���R��g`n%@&`��4@!��kP	�	�4�M ��� �p�au�bHa�qM͹��ty����{�����Y�l�k<v=��b�<A�n�q�{#�Mt���?�������D�^�      r   r   x�m���@Dѳ]�6�1�w�"� g*H���P��4��
��$�x��)����x�'��it<ȿ݆ }�LZ�qa�z/������>�w>�Uо����w^������/ �(u      k   �   x�m�;�0��>�K�����[SqK|E��3q.�����F3a4� =X(L�#9iZ𺀭 �'\��)�[�k��X ����q,��|�����fA �4L�,�##K����@&������A\�z��Y�ϝ�������1�7�˺ls�R� E�Q�      g   }  x��ۭe�
D�YQtG6~ �����?�;�RK-՞���bU������U��:��:_�^�I�c���\|�_yҵ�T�× �U-��ٮ��[�2N�ۭ�J+ö5�v�h�}�j��d�.uG���,:�}l]b�0e�W|<F�5�Q�hƘ��e���<��UbY1 x�"k�r�0x4��bRҝ,bm�т0A�6�lߥŐQP���c �����PE*��a!�RK��ߘh>*Yz��1�GQ��1��6 L�J@ʴ�E#mo�}�x��.
K�� 2���o��1(�O)g~+�dP#�x5O&���+^ny0�P�0}��|;�h��w�Y �>*�Z  �0T���rM��c4����1���i���1�4_'F�XPܘ!{&w��I+G@�l�~й]fIb�ɼ= b�zx��b�"��X�dV�*�bv] �I�?�7�*<f�����N�Ǥ���u5��ǜ��^�#m��4y���'�<����//Bd��3_����)ߊ��-���eM�?}��:UG��rq�Aݺ��Ź+�g$�k��-�3Ɣ�k�?�1c<�]�����R�C�gd�/Vz[C���:�=. Խʼ�����lt
q+�yCJ;s��b�e���d�,��G�H�DBk�Ʈ�O���ʩ���ԥ<�3ɖ��4�szf �Q�[�x�X�z0��ƙ4�rգI/��m)c@��a�����'Cvm��F $��ϰ�|���:֏)r�@��r�"E� ����Y蟖"�lFq L�c���� H���:K	�4)��� �K|�S_<����q���u`_��7�-c�I_L��哐R�{ս�OkZ�c1�.�VfL��� ̓p�7_ր]�a�m�9�'K�E~oOF�@ [�n�R�P�EW�x;O�Z�X��\��7�Y��;N����A?��\5��xlR�y
�ܳ��H=8�F9�-���)`Z���d���)���)���
&R1NA��Sv4�p
����i� \D��6������",�piT�ޢ8�/88#�3.�|�޳��q&H������� lx�E���b��ϝ'�gM�-��d8�����-�a�_-���@r�����|�$S�����SKʆ�� �+B�������@�㭛qr����r�J��}�����_Y-���)?&�i�?$#���NՓHF�a�\�S|O�xS� � Ԏ����wARRv��v><$5�ƕ�E�*MQ�q��k��5�u�-��p���o�q~�}P|�վ��mA�'ϑ�����8J�L{]�� >^L�G��w��'BO�b����|�3;��16�W�R��>�{g�d��w|�;��۞�ƶ��-Q��1ƞ�SC��?� �~�������ڜ      c      x�t�I��L�5����l|��6D� �wTk�D�C��T������������>�ˈU̹�dXwFI���(׭;�W��/	!Lwy�c:n{���0N+���K��Н�w�ah����ӥ����?l���l��O���a��n+��Qu��1R��k��gӤ��+�[5S~�.g����ه��&��k�^�<�����_�y�]�c�N������a�*%J0%2l�����fr�x�Ja)�������b��8�O3�	�m%�����z:9��}�?�J57��k�~ߌ�[Ih��
�����Ӫ��4j%a@�fD����$JhJ��.��Iw��V��Qz�8aʩ؊]��E�12Zmz�:��#f69��XqW��;S�(ܯ�c^�:�����~��Hӝ39��X����S�{���2���Tşn��N��]�2�r�N"a&��_��g7��{ԳEHDa:s7Mܯ�{����rxI���������Hϫ�9��\G��X��y�г�8F^%���{��F��uU��Zc�49�������q�W��=3"ۙ���Z�E���D�H��L�����6f�����9�%��X�$S�]�农k��������߸�e1��	\�r��]��nL�y�6j�KB�$���j�����~���xQ�"I�:>�}��,�X�� �8
��m�4��Z�bd����bw�EJ-��2̣Q7��\'��kg�д�ʠ�h�<���K��\<�F�wy_>&g���/"�QW���Q_�<��sOe���QF��\B����b�;~56[�Hd��Ҡ�<����6�/ՌM���o�3�"'u%0�N�X�$ �l^Gxd�N�r�ݲz��\A��;�E�ҝ	�j�爑�b�[X��z��+y�3�"�ka^Lbۭ���O�xԉ��i��y<�Q�(N��D�2�ew�w9���dtI3:_��������5O5k���ɻta<�apg��M.a��D�<����ND�_t��U�"$S�YzquIȬ�zX{�ݰ����I�z�x��Jv�O�����J�Ib���|TC"���y�6_� �����0��b�]��O|�,�f�?��8��hPq��J�qO��ni=g�)Ő׎kL���c�WW[?#�1u7v�T��~�F���N��k^�N� ���č|�!2���NB�
c�e^\�h�(''�����u�r����+�>R�́qz�X��_����H��K��aE�˂��NG��s�@S�f]��Knё�֬.��e�cjd����Is_���l�0e/z���N{�cAb�t6��n�I����9�_�x�~�7I<_�e���X���{���4Ţ�����vu��Ep������c?]TW.�xWF�]����q���m�X"MK]�x�������%��X�fx��D
��M������[�e�6�Ä��5Z-k���[���fQ�г�V�@S�a��<x�_׏ Hu�������4��Q,#vыG���\س�U�ov��z)�哝�o�k��s�8qbSRw�pޜ6��a:C�p���Ҥ��� �4�����%`K� O.�	1ԥ_~��^���y7�\��Se�^i=���������6�x!iެI�SvU�4x�!�&q�~^��֝�Ą�
]��6���'rb0oCq�S�'��ɫ�v�s�x~�5�4���^�{�4�Y�������O��ay^�D7@��*�ct�&'�!�VC��������`���:H(�	8÷�)������1
�j�'��(��蹁|as_#s�U̓ڝ�qI�1�u�U��ݺY��\��b������}�">�'�0��^��f�t*�{�.Rʥ�^�h��'�H�l���S*2�u�^������m_ *��`ǹ��+;.9�ā�r������������ET���zm'��H�ss<�˖�Z�\�}&2ڙ����`7��,S"�e�UZ�AD�s�?\
MhBw$p�������X��"���s9�ҡ�(�Y3����K񼌊��φb�/'µ>l�h��(r/��їl&a�B�)Ć8#�Ϡ�D�����N�����ĝd�u(���~����Ӥ�j�:��x\��h~������`!pga�e����_"w�S�J��;r���¼��}���F���
�?q��r��QX�`9J���X���]�;��Ψ�Z��)Ld}��:�.\�H�;r��]�N�:D"�2"�g����i��"" hX�=�#��G!�^.�.�©�����Z�H��sS��
]��Y�_Mu���Q0ί�1E�:7D&o\�m1.fQW��c}���@�b��I]�J�iG?ɑʯj�^��>-&��V�6��z�-��y��ش7J�E=�v`R�;j�~��"�[��I���c	Wӿ,���3���_Y�0���j�X]G�~0�+�sa[sq�X��0�j�u�_��F��G:x>���IeU��x�y#, F���C���'%����8�.N�<|Pu^]�4���@�����'<���8�kȌ��E�/8�)����Í�!�%J#�k�
 �s�����<^&�������)Z,������z��[��=���6��4Z��J���$�k�
�,�7�/��E	~���R�r�</}S���^8�Dg��4D��E�[��jj�`U.�8�M�*�TRɉB���6��],�KfZ�%���lͲ�|ms�͈���"
@�1|�NI��0%�Fl�;HP����B�b<���X�����sI���-_K��>������HY���%B��`�9*Q����`�_�C#�CK@�� V"�ֺ�ʧ�j���o��X��*���2��[��٫j��l��fh��U�m�<���2 b��;�Ϻ�����O�+�5ClY��_ؙ��P��������B���%�&��lsYl��E!\e0��?ʝ�� �ҝi
`���3��r��WĀg8����z/�_��)"=�^��N�n�reN�	W.w����7N�^��Ƥ��d��ř~cN.q����G��nT`1qp��5T��"���HZ�)�p%poAR�Vۇ8�}�K,�HiN:��x����
-�z,��г�9N�!	�� ��-��K�]�P�0`O =8��5��xB��� t�y�٪�s�gN�e�U�H9��	�T�h����g?�NrW������ay`�I�&_�8L�8�&��G]	�PGr�W���
 :M�5�{ ���:��7�=�;-��t���9n���YAYh�g3⇺���e��*
~o~���z�=� �w%�|�Dr�ԏD!���Х��n�t�l����㳻�݊���DC]���U('פ�[n>������D�Ďf���aZò]�da���8����P��#"��ۥ_�a.���� ���܆E�����A ��r@�M���!ޛ��daU$w�u�&N޿a�?�-t�����? (�SJ��_�M��2�U��M-O�#����ݪ�S�5U �t�-�b��Rv���BgD2�?y��aP� �;���O)D�
��(���.����K�U�fLc�.�uP�Pfܷ�6]�S�*%_��eG���=31��H[�@�C�����w�C]�-2�9.'�+	��T��~aj�t~�U�޿�&��G�^or�3���-����a�/ �")�r�K�k���l�0Q@�@WX����Od���� ���EY���|�~K7����1~x���;XMĿ7�E�N��s�v�+�!ܚ�l7�����"�8�x�.Â����D6�aD���0�h���3F��&s�b�!��fz�7���4V�,?.�R�h�l~#��wJ������1��oB�1P����/g����L�� ���.�
����b�g������.l�\!`����U{]��S��7�l��i��L���;?1˰*�4 ٿ����.X1�	��?����a� x&�bP�\1y�w���;���|��5VY����\��y    �x�ɓ�$X���,�7����k��Ml�b@��p�G�XVD����Dq�;����}�[G�<RP�Y�Ǽ8��[�{Ƥ��$ZLN���Tq;֘5R���5�ݼH�`F�+�%�"0���D��P,u0�p=����Ke粸e�A3U���ɽ�6�H�$S�^����et��v�hڋi�3����d���������':fШ@!�~C�}S��ʉ��zy�V��<�I5�����r҇*�&�,ώ�C`�1C�1p��y!�s�F��Y�6C���w�D�g�����n^���;k��n�Y��c��V���>�ʣ����#��^r@�f���4"q<�\%�Ix]��
��XX⯝���b� P<��lҋ�A��F�?S=s>������6_��HFsI����>�Q�:?NG?�����7��ٻyؚ;/�� o`?�?�,ς�s|`��1 W/�� ��ZG���6�Z�\-��e�)N����6�f����U���da�fW���6����$n���|~��[�� Z�; BL#�U���ߌ�C�q��M�b�]jZ��~�P�J��k9��P?"�՛�&V?C5��̝�}G��a��"0���<����Q%�	Q4�*�`�/7u�I@cZWcV�C�K����x�����H�o[��ۿ������� 9��4t�_�6�#|�D�'#u����wDI�� 8�Ug+�}�{�Þm̴P=M�3�r�;�Ϋ�q�moy=���X�  �(�,�����nA� �+� Q�����Ì�S���ܳ������}46Cq��{�C��E3���3v��A����l�8
�f�� o�����63�:h��ܱ��x�8ā[��,"C	�~������x�Tw�b���O[e�Zk%�bc���G��_�l��U��f��w4�4k���Ҡ@R�� &������Uf`7���v �P�{I"\�k�t�3]�0J7��(��5t��9f3IV�T^�c�t�����56�A��}?�W"���O"1KMN?ј���w��SH�K�o�.��q�OzҦ�c��h��f��u͘"���\*�u����`�Lf�d�1���i�d�-qmIJ�����	�HS�^
����.V�6�t�*fY�J�r����8�/�L�Q����ֲRn'*��4[�`� 	C���$��E�� `exD�+]��aMs���Q�lYśU:����K�,�k��5��x�i�lh:��Q#V�� $?H}�L��Z�|�#]L'~~揜28l$@He@�b�Y��/���F?�����9���-}'���c,F�x��F�T���K�Ͻ��j���Tΰ�YTy4_z�HB3��%p,�h w.��NHB�dY�˿��qC;+c�`�z�E��xf�9����7^E&O�w�t�o�b_�3��V��ൄx2�m��6�K�0x����z����#���S_�4����4
í6��������抵�]+�HX)��� yn�Uc�qڊb����< /�0�����?��SD4	��5S�4�<�rE���<z���,ѴЕ����2��Bg�)��6ᖣBi��te��������<|�2�Mu��	�b��հ :��+�\M��lli�$G��SF��bj׭z_��mG�*�j�5_�T��h>$�x-@�T�~P�к $t�^��=� ���-���+�H���ʼ�a�P�,������}�/�y�Η7�Ih��\�É��L�Cr!��}kx��[ǿ�T��e9�����ڂ	����^^&�l��-�K}5#{:es��@��m�3�o��a�x�7�bnr=�;�0����y3���2`L]����#��� nI ��ߑ���U�RV�	��eu��
O�r%���R��1g5�km����O�ĮE���G� ��VY���� ���u���#lA�~�%�P$�gr���P�M�f��`�ӑ�MW'?og�d����8��!�.3~�K�"i@������m�_$�Ad�sv�� ������N�N�`k�N��Ru�T*����y\W^]n�+�_����Č�+a�rd@��f���A%������nXI����Pf�o]��8�r铽�������ɍ�F�ж��g;��%o[Fu<�d�x��*�p6-��-HpX��� l|r�'��\�^B�DSѶ�ؙ|c���ck�[�ިr�jk�C�'���M�G�h�z�c���!a��IMR>a�E�|�b��%p6a�W�D ��@�G����]�8N�8�I��գ��KJ:�ls8rV�a;H�0�;����Q�!A����[IH�%8@�@En�?����_;�.\A�t*�}qLB�����U�r��rn�Y���rWm��lJ�@���$$�n����1��O��������+B�'r$ۍ)���h(2��DnqH��;N?�(]i�f:Q��ܚ���X��k�Y��zG�;������O�����H7�i@���6���I���LS�H<�{�)s6���Ӟ�n/u��;���LG)|�G_fo�� 8)
-�:O�g����X"KZZHY�3_�I�S�F���Sc�ˉaG��]�N�YU�`��w�WFH�c�N����q�V���;�U��H��7'"0U 4�sy~��	�V�%"@��}C��;���dX��r^�I��)�z[�u���IO������چ��7~����T�g���󬬵us��.p�I����BH����o�f<a�q�<���&�ל���׽r}�5˄�uU]�U8����0;x����Ns��I��#nM["�M��z̉X` ^�2>MB/�~��([ݴ��n�ͷ��ۺ+v���Γ^9q��.md;��e��5뾫4�!:��=���8�� t���OdHq4f�CP{iR�=Z�q9Z����3yH-c��uW�tq�������ּ޴"�e��l̸왻_3���k&�b����_5s����Z��8M�`�.i��L�1)a.�d�K�||<�����K��\��G�d4�υ:S�N��5����Hҳ��j�R5��U�pI��u�=S�O��}��1�؊r�yd�K�لj�X;Փ��.>K
�kԭ,��^\MHD��9�om�L뗑H�O��;��3p>V� ePx�פ\S�f�k����������B̙"1�^����9�jr�6D������e�UhL�9� zg��� ���wh�A0Q��^2s�|۳춇��n�q�#}ߍ�to6��RֹY1�k�zTs ���R�"�<�	#^����[Z��D����8� 
-�L �ؖ��Ыc�Ȕ�u�ܫ���d3;P���4��7i&c�Vr�r�vp�v�����L�6z�*ҳ�8��A����Ӄ����C1��H�w�X���xC��`j]f7�dG��!�.�v_��Q����p+�a��8��;�"�m�7�����h���0�b��32)��HД����c���m)M�d���F�{��8LLePl�l˦�u+	��q��O�h���&yn����SI M1<��-��ϔy�pM�F�B��I�T5#�}����X]n�b��E3��<�3"����:�|�T�u:"�I���tRr�YAY
���[�ԛ�z�o�rw~ܧb�?ܶs�;;�.*�fv��@�k�щ<W�P^�DԚ�k_{��l˱mߒD�(�FBkM��?�1Ó�.���Z^�&�}v�릉7Lhj��6������U�o�L|P�d�t�35�sM%����iH4ϓ�Z��Mc�4 � }�N���!����G!�$�`ox�=^ǫ��Q�7���2S]\��l��gn�ɧ�a܌�h=*����rF��m��"
�ږ@�t^  U�x�_�<#��"�$�Bș���q�_&���G��N�u�)�.ϹP���A�gW_V�j���$-UBG����i��3X1�Vc�4K�\ǯ�B��$���
��Z�M�3h�٩�G i��Ӧ(���/r|H6\�N����ߔ��jl    �cI-"/��+�|���ؕHG�ݞ��\h�@x�
/&-]��T���܍�ǎ6��Y���{�af�4��Z������1�jB�KCڴ�{ p�~�xmX�!��N��p	����z���y"l�E�q���{�Q8�*ƥ������/*�ѮI*�a�Ml*��ElKX4D�6w���cXA���h���j O�����˚�I�`�����'m���:��Kg��$d��c8_Qp�i9q5�����[濙�+0�V�?�4O=�;L���Y�)7t4����IG�q֥�>=��r�7j�ǑQ��"=O���H{8lE�8L-�E�����ߞ~8@�-���;ކNf�:O���xN�z	�a�J7�:&�ao�fP������䡡d��N�o5DuI�ŕ��~�#��mC��<�̰ݡ� Y \@��0�s�╵�V�0��\*����ce�&�qjQ��IX�\�F�2����ϫ`g�o&�t,��rm祈S������ŏ"D�%#��4#�R�zQ#O�y/|�̴u]f��k5��3�6aˬ3[\�</Нq�,~���V��Ȥ���ڂ��~G?X�|�X���C�j�����w���G��*4]،�?���Rъ�Z�F���]OJ/D�� �_��x�c�"�M�8�S�ǟY%��~����1�7����E�y�M�����V8�}���\��E�}}y�ȼ���d�k'���V�נ��'�kC�\ ��-����Ec�l��HҴ �^3؛�(ă0�Y�Z��%��Ps�{�;E�'ʗ�D85�o�j��%.�c;����^B'��ȼ <|	�D�_Ȇ��H�I��
���ɔ���wPw��כd��8���~m�b���r6�r�5�z"�ن��,d���#�����n�g�$
���Dq$�#�o�T����K�¡����Gy�Z�V��Ѷ��!f�*cW^��Њ�c�!l��;{��҃�?z�TI�B��:u{�g��s$=�� sH3����a�a9���#���9�Yu����y�5��Z�&s7|��i���@|��S �{�ZEzRX�-���Z��@]0�͐����w����K;���s��:�o�t7[���8�����_�]o<?
qS��^S��G��9�l��8�' P1轒����)��a�ؼ>^1*WTv�F��t�J=X�REf=\���m���}�gN�C����"a���`���%3�����A�Is?8��Z�~�)X-zH��s*˜�z�դ���'��Z05&b��}��}��\#r�`�,J��4��I�9�Ő�U�S��>M?�0&M /
=�N��6�'����	�L����o�v�\/�6O)�1u��S���V.u�n[�܀�+��+xx�.˒�����i
�"?�K<wJ1�{w��Ɣ��)���=<�v'vp���\��`���%x3=��܊�3mR2�^�LK�Y�+� �2h?�GƔ r���)�����&a�	�	eE�����>ƻE�MO�=S]YW�b�؟���c�V����钂��s}z"�7� E�4҄�1oMq��<@7F�;����т��E��)�	��f�2�%?V�Q#�o�b?KE�H:�1ߺſF�I��Lc#	��D�y�sU��ɴ/���{�.�
����[�����[n8tݝ�|��Y�}3RI#S4f&��*��K<ki��m�����@�,�O��
�I��oN�~��x�J�*Fjme��#{��ܕm�$ڦ�a����qI�(	ߠ|�	��"��揗@�[������y��ͻ�{>�����~y<�����h]�e�q�fi8kEÝ��:_�����m�%�U�E��p���AZ -�X�k�1=����+��沂K3�w��;Z�滭���\�t���qp�H!��q�z�of�� ��AU���[>�D��D1$Y�ڛr1�Yl�D�x˪cW���|��-�cinf�n�o��Q�u�o�D�3��0q��4w^�e�<�������I�)�q���ڤ��q�.���W���Q�{LO;7m)�_�G��ȷ#�������r�'�ts���z�2����H𡤑���$@��hix�h G!�Q|�K�%H��ƺ�L�Ҟ���f��x��9�և8t7�Jx��]���F��%����=;�ڸ& 9늤E�#gU�9�t��Ozf������l�jB�G�ȱ�6RN�lxSR3����c�Tq��Ki���I��4���1��F궤Գ]} ���_I�%�w H�ТDx�t]��+kU��7�%q�������ғ}�d�pK{W�T�[�V����iL�/�M���˃���	��F0�����u8Lh����k��-ʹox�0^=���x�i�%��vi��i��PG�.4��B�᧱[�����Y�&a��B@#��?�])���	o�`r_��-'��{Z�&��V�h�����ĸb��L��y��b���� h�����͌��ï��w"8�h�h������@5-�3,��r@�&��@-�S�ZBꅰ��D��Ò���V�.�[��K�;#�FZ*_t�-���d��m�?S��x�L�Vp�f�˼���	/�JΧ���9y.��8p#���G6�9�!kr�;�ȚO,�Nņ�o��̍�+��J�B3R��J�>��=�K����Y�� �k|M�K���I�UA�Fb��.����}2��>b�� ����S~��fIʴ���̯u�����?��,���_��q}��e#,��Zb�8b�q)k��{��/�Kam�f'�|6R�\	�{���-C�iݶW�6R����@r�'�`ipL �rpd�ț�g(�1ၝ�=oa�c�*��%9�W���e5����~���q��cH��#� Ҽj�yN���v1�������8�>�t�<,�n�����^Lk��c�L]9a�m��)<WJfH����q��d���.e��Ԋ�"�#�ݗ����q]V�o���������v�ToZs14S<�s;>�"���-���ܝl�ss}7䍨���a���Z\S���T��k.���I�g��9_�Ȏ�DR\w�?n	��+��63�]Ic����x�?z�u,b-Ĳo�����y�ٔ�4s�8��b�I��z��B;����B[K����a�Hp�9�NVԴy���3s���)M�.�����-���9���i��utZ��ǚ�UrY>ZA�Βl���B=k��^�`7����\�L /H��л�ܒlN׃2���f����7�+��R������·�|��M\��k�q%�4@2n���2�����Ř�9�I�&����
��N�L��cfs�3�g���f��0m�^����?o��zAW��1�	���oe�wذE��i�<����7r�x�����H�Ha�^�����~�����ݼqu~�y��բ$�Gu?�1^�w��^��a2̆Lq���~�9@�.Ð����_�l�[�Fo.pv<��nU��a`Hwou�4�s�i/�N�-�9Z%}%?FF<�?�K��:�&n��3t
�Q62�\�$���
KR1��(xY���J��݉�
���_��M����-�]4�w�E���y��9Ꟑ/��#0���>4�}�vOKml@?���q^Fz�}�R�_�)�S�U�\���N�`��Ja����	�<���F���)�0��:��E�	L�'�H�����{�<� Iq��XV�8�=yxK����!�q�4��+��ђ^z���Ș��/58�Rذs�d��w�J�(0�s�<P�.�h	��+)���6b�`U��QX�o6�8����Ioi�Z�.p�W�7�~x�;��1��9>�۸���f�p���J �ߍ���2"��H����l��
ƫN��g��krF���1t�������glm�3��x�����C���gjӻ;�<+{*�G�`(hq�o�D���ao�9��畞(�Y���nxޭ�&��|#DV���*i©O��?�bc>�[��g�+0	��P|8�'    CJ|�%�Y�ý�T�~����5/�t�������[�������o�=��=afuBļ�/��{�QhǡD ���3�7�A��Ds��@E0�v���:��Y�C�sA�&�?�Р�ʩ�o�3�c��ք8�Y�� �XX��r�ymGkA�NtL���k�aU�2 ψ|���u���v���lc��%��
5q�J�%�^���a��A�$�A?k���q�KK�_+�m���d����#���������������l�1	�T=ϻ^}Օ�b,�:/3qp��ܳ�˴��\��-j���Fk(o��	���M�$ϑ�7h��8�����=S�k�~H�b�U���'3g{�p1���$M����X\�A�o�Z��3_���HmB(�-��V~P����fka�u0����~��{5'�����G�B��u��ν��'�=f�kj��%%�ޞ�P}�MU?���W��z�}���(��<,�j�	��ku/�&��4�W}ĊհZ-d꾚fn3��g�\fsV:�����|�7��v��6�n�����y���m:��㟝q��/�n���ɶH.��Rn7k?�n�t����p�i;����u�ݥ�:�=�P�C��צ�S��b��Ó^������ 4�����	)�J�/�t�{��oN�x0���~�-���?�)+�'��R�0I~�tJ����Or��F n����;����3��x����3x�f5��W�m�+��N���Ln+�=���-�|#{d�%�g��v�R`��H�����k�@-$�w�o���(�d5+��>6��A��ӵ�j���󾌆�����)�"�
`�c3���8?g����a8��S�M�!�����"��Y���Q� �XK����u����L7��]?f���$��=Ck��J��v'B�$��� ��⥙[l���(X�9�|�Ϣ-����|ʵq�=�CU�c�*�W��;�oޖ�m���g9�^�*�WJ܏��z3�~��Y+O:���Ϟ�0�E8�Ȯ��_��_-�Ips�潑N.�7�����F��%X�P[��tME{h���RF�p@�#�z:ia$K�&����^"��ː�4��a{�W���@ox��R�e���>�Ԟ�k1���aN�`��ԍ�p�<�|����d�:^����M�nH�����
��n'�7	���?*)9A<;��)�`j`	/�}���=2w�ޏQ���
b(ĳz�˛}��ꄚP����Y�	�u��zz)Q��.@$�Q����_��F4�������kv9�_�u��ev]1`�� 9�Ȏ���q��� j~�M{�7x0��C��I��M��H�����l��J��e	@��+����?F(��gq<qX���Шly���z�?�f�X�ɰ��Ebg�&��?�S��r_�y&,���_���/ ��c�"+�Ƞ�[���ܟ�W~��V�cU��\)��Yy� ����v�}k'*���紫��x��T�ۏ��{�r��\9��'�o�Nv�I��'�w6.�a�O�<f��%Mݣ��	K��g[��m�&>���l2����UըsL���v[m!�w=�N���oi$�8�O����~��z&��J�;�l�����̮ڎ�X�z�]nD}�`H�C�#��ƍ}&S6��Q�&!�c����nx![7D�Q�#�oJ�}�+``wY�Q�c����=o��ʃ]- F��E�̓�jtLg�!�9wS��b=��k��+�T3��v�84��# �#;]A�N?�lq�X��@�v���?BAw-IV*�W|=�Ws|�&��Ɲ�oU�-��A?��`�ڢ�l����8�ӗe��j�Yx12��_��Y��h�8�Dqd� #������
��.����|o5����b���������k?+D��kA�o��s� ��o~��~0�AQ���4b�̛6�ӣ�e���o�[��I�д�b\���3֢.�l4�����ͬF���/��^õ-4!��+�~�Ay ��c�<��1���A�R��`td�B�����XR˰�\9?�5#�8��^8L��躍(�'���3�n�b��߲f2��m��c7��I"��;d�#l�a��t�o��U}k��E�^���*.?�}��y/�me�;�r���%t��3Lg\9�PhV�I��B�.���c���5E�u�%�'R�[�7>L3����^��֬�0NZ\3�as�o�I��j�ҲaF�{3d|�:`]ϑ���c����s&���0�D�\GjW���۫<`��:Z���P���Zt�$�b��>�f�>7����"�
9����l�4����qLx��Ť��u��z ����:��5�y��_pF�ǌ�ur#	�����t��c��C����y�a9.c>,�k�[�Zq@�M;0��f�o���A� ��g����D2��D	Hh���|�Z��J:ޔ4��'>�B��]�9G7X\��U�����{�;'�L�H�l ;��h<n��ɘ ��<?�)-�l;�/��K2�a�u�f00{��aOv|ٻ���ОiEB\e8�/�1v��`�7����bw@�#�������9~x�ˑ�*�u��54V"Mc2�E��D�V^�!՟lx��!�xe|9l�E�C���%W_���2�\\���K��k��^J7m&�����p��G�Ea��%f�@�ަɄ�9�0��;=Y�8����N����X
���}�Ъ�.��� 
A��-�埽 kD�����5p0�Ɏ�\���}�3��9=8��W'��!#�Ts���K9�1�mU�r������y�_3y�ণo3k�b�.GF�]8|����"�K1EQ��*Jo����޳�WƐ��jƘ|����fu�]ݮ��N�{����`$�4*ۭ���yS�3Ղ�6;Fő�0�#l��2<P%�&H$Ԑ������jXV�r��9�?�Lݪ����`,nt!s�D8.E#=�hZ�Y)LG�D?��wm{+`Vbc���4��1�bEF �A�1I.
�����1����x��K�c�f�1cL�ܞ��E�܏���ۗ�t0�\�v��Y�7�%��[iwӠ^99���������a�F	H!˿�»��px�V�]!i��W�屢�k���^[�$�E��N'˾�fkR�{n�����m� �J����|� ��`c`�s�z,v�ˋ�f<ev���Ǆ�6h�-,Mf��Y�T�Y�2[��e�K~$�ʔ�V�}w��A���ů!�B�wK�`�.LD*m���?�(ʽ�
�E��ñ{ڬ��|_�:��ѽބ٠����S��o��0�ݹ����M0��BRln]�4�8�$�o�e�����Z��<8�#��������UԠ�S�m8?��x��3���f��c~ve�MYi�L�2�]���]?۲�cr4- {#K��	IaȲ��F{}?�M���;���Q��q&쌺_�x�(k6$>���3Q�]=�u�
ۡ�_���:�,E$���� ��"��( �1���u�4�ڸh.9��ő���8������������ m���������p���]�-��9|���WX8�  �o���v�s����@�h�Q<������K��Δ��L�o�h:�
o�n�����jP��ΒRb*�۷��,�YC(�bvp�U'<8��BˇD���$���k`Y6����Xw,��xt/&�z�g�ǐJTw�f����y'�[�C�g����� l����3��bH��]����?­ē�`�R$K�捗��B���ͧ����LU[^W�}!#��OƱ���`*%ZdM�yh}��7L��%,��������̖�l���΄O�x��\4��
<�,��V#s�j�G7%_,��J�e�ϫ�5���Mg���G>MO�}�T9��%�{%٭�8 �]�8�	>@G�
!  �=�꼂 %t���b�8��([����(�6p�&p��qw<{�)��mɻa����7;��H�*�v��� y$tG �j�eٷ�	u+[v��rc�S�    J��j~�R�j�7��C1b�H��f�c|<�#��f`��Y�چZ��K 2�6R��Ȟ^�L��'"�Ҟ�֯p�PQ���KX�����_m�I��Y�v��� (G��[��"mw������O�<����О��6/=jW?} @� 6�2�&������.fP�F�Rў��@"�#3��C<u��A�^5Q�K'��9�^����m\�XOf؟?D�8E�HQb��R
8���~���s�Jfu=�gQ�q0����^��hOg�ODG�&��''�s�\+ӵr��<��%$�fx���Y#Lc���CVŐE�Xo���x�^�#K�8��nNڀ��vxM��X��P�c���T#�-��u�b��wW�@	��i���-|�'VD�H헡�]��`Z$F NJ�`f�]���f<=S�r�u�>������c�ȧ�=��c�,�0�^���C�s�	��������oA�<��tm��["��|��8�����>s�[Z���[y���m<x̵&U�q1�;��e��C7�ݯSZ��lI`I)T,k?.���3<�=��Y=��gq%nW[���A=�&";���F�Cn���C[崿�����h;�F�$ܑ���E����ue[�"��9�W��H�<"�
�����tJ+~��f����P��1�[D�5W7'��;[P�J�OYG��E����p�P�=K}�[A3��>��}�pf���5��}>GOkQ����PY4�`Mӂ�\�H◍�#�T��|�I@ ���$�m��K�Ƀf�2o�~�R�dm���h�*���OD�L<E^�cYZY�.�Ϋ�}QTO�3<~Iv·�Fx_�:P�7���q�a98�敧_�D���͏���A��u�L���`��(>�ܛ�ַ�G����|!r������`�:��� 8z���\���V�m8$�����_J�v�9_n����i�[Θ.�(�=�7���md�5'�7]����`H摖u�a�;��b#���H���Kq��R�s~ᔚH�ȿ��n��?�U+5��yYQ�Ny���W/e��,餟WQz=�=� è$�ohe���x�nz�Z~�U>E�{�����i鵣�,��۶1S.Bwpy�ѩ6��('�%#�*�i94��\M:gG�f������4��00�=O���X:8��0x�io� }�:���	'���͕�w'X��t3=��Ґ�X�g&���v��'�9!?[4fP��!��A|�� d�n�h��H� 
�T�K���2�H�ΧkR���;�|<�.r�v��t����t\��Hv���x�@�. :��ƣ���"�y�QJ���WEYr}�_"��c��!�K����Q7����Ou��O�mf�kԕ��)����_I$?�U8���摁���$���(|L�;zy!\�(G�8�?̋�Ȭ�BN��i� o���)k�{��-�V؟y�oR�K*)$ᾚ����"�~�g|Ͼ�=$<���� �a�����x��z�<Jze��-�QKO��Nꅕor�q�5Ý�r�ݹ�Df(OEn�M��+�u[[�`��I^���Nf�TJ��$o��H�#�j��\�K1xh�67=3qnuB��0�zN3ͧ��؉���)����m��:6�Ei�	p?n�~[�8��"���������>FCz�d��4dD�<��-��&���^���K�
�Ij�Ɩ�z�t�}]�|���b�9N	!�E�W�&���"��cxV����aDj���
7	��g���4a�OWL�RE_���%��f�j#wT�ǥ��M�FVcdp����ר�.t���N�fN�~GOݓ�{��q��zŹ�=�d/���Ƽ;Y7�~�6����tH�%f|.�sz���1�ȃ��d�I�1E �頵�H��#ꏛ�p�_<�^t�{���"#�4O xĈ/��-�f��6̉B�M.���)����q;��O�>��S�7��>��[T"?�g�B؇8�cC0��=4�`���"K��b@�W"1(zv �h�.��r�D�CR��vaj�¤Ls�b,g�m�ӣY�^<�G��������`IQe�R��`z�#c�G�`V��$,	�>c�yf	��f�����2�τ���2�hw�����0
��f,��>��(�����U?q���px��ˊ������V�l�9����g�0�Es�[��`�����Q��-�v:]۳��u#��A�D]�`D{���,$��"��#/~s���͢(�MT	�θ��,�蹨Gk��jY��]Cq�ʎ��n��ë;�s��T�����A?!A��|��n��Q1�y*����I�B/T X�M�/�ߦjۦ���!��@����B#��J�����s!�ӂ��Q�;�T�^�~��tm�z(���Ћ�D>��R�{�����gڗ{���ҦTv+��S��ia�`�ڰ��J��������3���ȵ,,�9��\��B~��BX��^�lm�,�����+=]��gfz͙�E�hm�0�]
$y>�������d������^zky��oy����̀>�l"X��	!b�à����M��f9W^�È3���٤��o��r�_n/q%pKc5�SFKxh��"�S3��L��1�K/]�?��CȄD�E��O���Z<WS�@;wv�7�-ɣ�Z*�Tz+մWF�)O�Y��瀥D!�����U�wD?��8�/�F߳�}p�Jж�/�[��'�z�FɁUf�EO�G}r��b�!�Y�iwՃ�ރ;��F�S�U(F&�c)��XE�ͺ���P�ru9^~Go,.!� 	zV$�����	�s8o��Yj�M�ޭ
9�g[~K�ڑ���V<j�.�n�ʸ�����>5?��$���?Aw�;S�!�h����EL��B_�3m�%�F���:��VKVwj�mp9����[{{8�#?�EW�.�������a�n�F�OT�hק��N俲�_���Ps�!�H�42Ȝ=7ZO����8Ȃ}2�s�ik�,w\��le�e��GVv@������(�I��jN�f���£80��%@@����b���/����I��3-����Q�m��}��P�k��\��=����ơ��f�Ʒ5È�(��#8x��6����HP>���@�������O{�/��*�������{�����I�-%c�#H�Z��\��#���e���iM���W� �M�Gv��P��+8�^����%�S"!��zB�sӟ�9�T%��E8�S�q��r	wYw�b��^���
��	9��xk0�^�򇎘��t�_������*� � 	�9_�y8W�$Gd?�n(6�P�Es���v����]ݦU1��N�t�ZB�)���� ���@����^��M"��%GJ��{m��n��!irEv�q�q<B�d�X���[-��ȵ�VuNʴ,�����K����!�:���yn�wd^Yd�A��B�L�"��YFof�X�,�@�s7h���gFvƉ�/��A�l�=N���x:O�a�

7�>ξI@y�qJXO��,��	:Jd�DhSxwE��L6^�����Es�5��ƍ��l�&��f{#��m>
���� ��?������4(�a� 	��P�C�I�'�E�x0mRt�s�.���ֵ=g�!$�>�]ڽ��<�zyn���U�m�!I_�d��ͷ�ív"	�_fo���j)P��*}q��nq��|ʼ:ԙ�M���l�n���1�Q� R�8#Gs���u�1��K�^+���0���1� �tAc�G��(������$p���7ʽ0.F������-����j�z(p��#�Q�li���c5�,��l����
�����U}�l�A��z��q�odp�G$��z2��������e8)�m%s�������~�R��
氟�e[�b	6�m@�={#椡�O�(���>�� �#�w�:r�fp�
��*��`G�Œs�d����(���)z*q�n;���x�@{P�}����bD"� �AZ���#HHBr�K��Rnhz    ^Mg���{%�n���I�s�jE�����-��*�]/k���B�R�4E���C��]�*���}�=~Q@n��cY��Y����g��.�-��q;]����lC��C���p�rkV��8��&wb	�~�w9t�SԗR�����G����a��O������'
�`
�Ka��O��T�������X����뺩7�b'�c��]�ֶ�.<�?�D� �aۇ�I$y:^�Dl�oTl�	�R����X��^ZYz6!�U~�&�p0(��`V�uK��r��t���QD��Ii��6�tІ�>�m��`���V�ه%`�]����O��8L�Q�*�x�)�S�!���G�V�����<�L�	�v�p�*�KJ��R#�9�$�"G}�@&���#�Ȭ����L/����C*QE~�9;)��tP4�9���ZODok�쀾N��pf��N�f�h�\PF|���,�Ap]�O�o,�E�I�dz:���*H�?wN�o��SIL?rf��t�m����YY���Q��mr?^�����C��a��D��BO�/B��W?x?��P(�b��ѓ�Q`���s���<�ߴ��t��05��3^����3�<�n�H�MO'�,����<% c>��Lߣ�G�$
��Տ�w�l�M�+E1/�OՀ\ն�KÈ�!a��ڎLӪho�0S�3�R�lzuH�0`'�O-�E�?�pQ�H��?��w�-�G�yw�#q5�]�e��m<.�K��RJ���zX��&�{gϽ�ӯ�N�Zh�c���ϰ���DU�?�A�V`q��m�I�Xj�,������E`sO�n��Q��=�J��`¦-��@���t,Q�O��ʅ�ܒ�]�*\d��\>� ��F"g(@�#~�X	��&S��ce	]��d����M�Q�&W�m��R:�g(�������㘼G­,�����q���
>�M0�ѯ�8.�s��W,vy��lg��勁�vF���&U�^���s�q҅�������c*�������H���fѾP�KB�a; ��y��D'��"}��1��x"�5X��'�>�`����d�s�3��e�Oވ"�o���PZZy�T��,f<�K)�.�Z�%��%�fq�Q��z�@�:��o^*W�}�_"�q8���Rl���j6�!nX�a���LV��A	#����)�^��=L%�aG�`��h0Π��y	a��?���}P�D��Y�t��&���{w;�.������m����nzoN����R�4��Nަ�f����q�/��F ݄n��8�<��U�H(���Q�d-M���dhF��ll�Φ��8�Ja^Jkӝ�<>��#}�Ñ�J�C�C}Q}ҏPF�`�g��� �Q���m�P���̞3��Qr2�?]Ɗ88���9U�j09���/w�W�����M7Ȉs	 B�����m+~D4����Y��roV��d&i���M�|s����D�@�.�h�a�z	a���E�齖�l7
�=�薢���%l0C�&�N��U؃�H�q=c����M
���?=)}%���&ew����C���SUڸ^�jM�oJ.�&cji�l��6�/��?��j�H$�\����nyX�%��P���(9 ny�߉��hV��*��N���#,�M����z�4�E#�ʅ��������j4�o��W��av�8�e9�w���>�3���/�t6������庤�,�����(Ӎ9�v#�>�R�j��</�IiR㳑�g+~>��"%AQ�C12��x�D<̛�D~	6�e���x��\k�ub8����%l���lYN�+�0���-��������֨�;	ã��ԯ�2!�s!��\=Z�d閾�$�d[��YU�ǜ^���@�&wv���N,� ��pOS��L�a�*�q���-Pl��BBXT��� V�f��ӣ��Lߤ����;���J��-:g���6;_�UJy�@����Ϝ��?]瘾���Hf�~����D`ky�g*�N�	�޹H�]7S����;��aur܉!�	ki���3���"���0#�rpJ�1ԣ��ɺ3�~YA0�yL���������a�!�֟M6Il��q���cY�΅�6�=�H��3�ɡ�ݲ���P����G�	�>(�e�33K�IxA8	!��� �|�>+F��p�	]1��[7��ۘ����W�Ѕ`Y�WZ�wp
K���1&��ٷ�����b����ӡD�nt��>�JU��21�a��������s�	��X�y��������
K@8�@Q�Gq�{����BQ�8����x	?��T����!�Ko�M;l�N1W���r�,Yj�H�K=.����Y2��n5��qv�G�n�7��O�fh(���W�~��/�f�`�m�k����]Nv�1�t�Of�0G��;@����zuЮ5�ݸ�fX�F��v��+Ң��/�o!^�`��0sZ��7��_�D�#� �Kzt�(}�Ɠ���˃�$v;���@=�;C*S�t�]�d̥�zӇ F��I��qõo��g`1�I�='��U�|�3���a��fږ��y"�	W��Mr��%������`|�� ����`r?����?�qs(����w� �k�/~�"�ϓ�z=���A�z��Hl��̯R!��p@��Ɲ��aX̧
�B���O�mO�%	����F��bۛ���w������"��-�jı�-d�=�ٻ�/�[+��n�ф����ޓ�U	FǋJ��Uq�$��eS����(L偰�W�V�8{�]�
�*	trE���e{f6��:2n�~�Õ(Z(�����`n[V:
΍=�����'��0:8 �� ��Xa�P��.N@V��V�
V�>� �&�#Y�h[:FMl�FefT��4�)ױ	�;��Q����V9�2�����v�v°����k껑8y��J��{s#���s�c晓��&��I�a��{��;�\O�Ʃ�.Cv%-�SB=�&�L�����|L����q$<�ky����*	 �����r���0p̔�[ۜ�sn~�����Τ�����U��@��+
�D�S�'&�<Ţ��˟����A�&��`���a8]d���	J���`ܟ��wZ�c�ZŢI�&Ȗ����
��Q��dLhr�4�</��&�X��S}��P����1�ǻ�N!Lܵ$��t�s�ߴ�w��]�v=��Ji�G���&�7R�����ٸ�zv:��:� 兯Y|����(��<3OS�6r�xm`� ��4?��W�JAwSn���.z�*%���F�H:wse5�2�b�_�TcrN8�X�p���}� �:�"���=���K���.��|��a��Zk��SA�)G,�MM���.���V�-N�d��: (���
��D��?a\d0�
X�4ڀ~FS�?���31v��c�6rw�Cn��7ˍ8�v)_nV)���ۋ\�r�]��7q��5�m�>8$f[�#���}�"�מ�DU�l:
f+n9^Z��F����o������vSk`���0����n���ϊ�"9
�ES�<�'fn}	��)�*���]G�4�ֹh�;1�|ݒχۖ>M���,����\;w�g�h�ꉪ��3&PH�{�p����N��˗�#k�Zb���S}ו�T��x���jt;�;	f��e2���g���e�i�"����!�M��X%h��1�l�B��x��-��^��z�����k��aj�(�l�㌳��d��fh�ؔ�����`ڐ��n��E���gh��i��pUD��3LN��1��u��&��9���'õ@�N,Y?p��xl�Ӎ������啸S>�;�7q�����!��������!r��'�{�L�����^��*Y�v�m��U=���t�����J�5kT��������+�;�E�	0�<��;_���$A�D��m�mR:��9�B�˃<2�0���a`�����Be��0揕ܬ��fG"R�e��l���/��G��SP3e0���3ꦯ�^�v�����D*=g�·z��ʣU�    ;���a��+�S�Dd���ϐ�~.W�d�o��NɆ�9�A-�JpV$(�d|֭����DQꟻ�"�,�s�����Zh��#��To�K�Dk"$��}��R�?�X�y��j�|���R��!��9W�%��*q�l���챪�U���xvd5����VvZ4$��Q�u(qFu�aq:|w= \C��Q
{�[��� Snp��D|f����Qk��ȗ)J�.�7�#S�Rf}��`�M�!��7����v ��E~(�װ��S0@�B/~��Ɨ	���?�9aw�=aݺ2Sk����d��y��C'd����m�Iw��O}2��C�+Dp:������ߖ���v^��܃Q���VJ0�?N"�Ɂ�Ax�}��c�h�BؒPlӣ`�5[\5ղ����ӻ�Ϊ�	}�+��|\��)|����%�0=�.�O����#!S�b�so�1�����<P2%J�|\���&�X��M}��Q�&���%Y�#~�Nba�c��űxGXk�dRX��!��
E�<������щ��$��p��l��:A:��d�*�a�3+��3�8m!P��qJ�C���P���=�j�[J@p�D`&�(�~gD���bz�W��8t��0�a!D����S=�͘�.�����K��^q�5l~M- �!r�7�^�|�$�Ҁv���2A��}�8�ذ��1�z;�(m�8��l8�����a.woZ�u�n6�qG��w�zf���-���4g� ���'%+d �� `����Im֊�HË5���[�#p9��D�oG�d�s�2Qv�)ʎ������������s����Ƥ�纏�qH����rf,��`dN+�b�,�Z�$�I0�b{��i�4O�!8/55��3���C��������J%>��'�S�Eȋ&$(�>g$�s/��gN$����2�H�@$����h3�+#�y6���n�U�f1�Fo� �iTx��,��a�CKo�=sL<M��7ܕV�ܭP�h\���T��&9���s�l��q:��k)�hc3۶�V�:��˩k�*T��q�8fi�it�胰_�~�`��I���8���'��򑞦� 8(�I���2�OxsK����cV);��^M��K6�	R�aKH��S����0�&28��w�rZ��L_��pB�1_��cY<ؑ�;�&��ngE�%���	�=�����cb؅�e�~��(bJX���4�Ԓ%a3Kς��ٮ��\[���]O�G��a3�D�t��z\�YvȔ�_��B�!f�Q̄^˿0�}D+�@ȕ��)|!7���EtK)t��$�#x�{������f�C|�p�lzЈ�����\��^X��b�/=�7#����z���������P<���O�5(��B���a����x��Fa+�h�GgOZq��6�x+�J��.��D#�S>�� n	2ܣpb���#�ǤY��A�����I�Q=�xz��+��u܋��vo��X1�6��jo��-�b`w�a~P7?ߡЧ����Э��}�.
�(SOx�=����I�kIa�Q�gHJ6��Z��:�\��������m+u<iT����wW�,����Ū�=���U������5�%J�:�ŷ���4��*��ngM�ӱ�̩�Ζy�n�H����z�zyE���J��H���xU�������U�dv����/��v��M���T����Vu����;x���
���Sb>\rd6(f5��5� �~P����3���{�����������O�����Ԭm��D�77kn�����[E0ͭ;&y�U6�El��O�7Ђ����E��O3|�E�,�������/�%�:��x�u�D��҄�e�k��X����y�V�)��J
Q����_���B����>X��;��he�?�d���J��A���Dts9L��	�i��wG������:��)_׶s^׶ k�)��PKoRV	��(�޹!l��+����<�A
�4��Xze��Տf	�� ����is]O��,�hӻ�/��+�e���5L��y�nn��J{7�<h��!�k�T0n����K��'g��w��-�8��X���(6|Y��l�˙���<"ۛ>W��Ym+��R��Ȝ͋��(#xմ��et���Tp�ı0�ˢ�/2��I�"�S�p�e?:Y�,�'�8�Z\P��:��gWY���z�b*5�C�{�͠��1���/�◐�Q� )ŵ_X|� C�
/!���H	�n�ˬ	q���go,K��xNV�;��W7�Qd~4�i�7��lr[�����0�O�o��`������!����(J/\Eny�_�Q��
ȷv�b��	i!X+f��b����E�PT�ˋk��`+�O8��'#0�_xC�����tI�H���s��*��h�1�l��^�^�� �jՎ�MX\l��fk~:��΄I�a�YTѷ�9�Kp�T��06�ղ���	H�>g�4y�Fy�L��kG�!����L�;r+eL�t���J�İX���Z�.�,�\��h�P ���j��a��͑H"� \GJ=mE�/mݳ��=��SU�o�L2�8��_Nڌ]Ui1��[�q?����3�.�o��G��#�o4C��n�-E�M����Sx��rj3�̯�Y�-�pó���~�4J<=���ѭ���D[a�/5,��E��n�I�������m��u����
A�;J��49ߊ�:�'�Ys�Yxgi��Tk�x�ĕ
��.ߓ@�n�����)+�="GG�"G����1����q�m>��䈸nm��.�x������A�U������*�V���	\���g��Fq�����/D��$(բM �;jB���]E�5�So`�����8�o�AX��p{|��nk�8X�'��R�0<��{���}3�K�c�����	TM=,��w�ȑ_"�U�������%�gb�\@"���)�M.=;���Fk='�"շ���Վg~>]j|NV�����ኃZM#4��2�SE�ߌz)za���}m��j~n��պNji�D�	�mm�ּn�$�N4 �i�j"���-G���_1���_I�adj�H`�"H�[�a쟋CNH��YR�)G�X��Žx��<�M��ir��h���ਯ)��@���o�s��DqU�g�g;� ����|8�����+�6�F*9Te�6:������)���I��T�E��IM�rc��|p�H�b��G	L|L�
PM`�I��,9
��P3Bg�|7�N	Az�Y���d]U;�V��֡	�JU.���:��͉��͓m�n����� ��`�p�=�ߺ�K<�ɐ)�O9t�a������H�B/�ч��\.�$� Y��p?2�F �{WH�8p{�FL��})�y2��4������FG$�o�a���4���@�:�cJ�K5�Xw�0������%�dK:�h��<z]�Ma=�%7���!.�����^��1<fQ$	m��W?yK�ӠJ<�,��K"�~�%M���,<����ђ����Z��^��`���|*4ki,�2��YPo�ɣH^)�ho��K�2(�DFj�W?k!��v��^Z{`\�(���t���YAZV��bG��t��֪���\��`���)���@"4
c �^�4��H=̕p(Ԏ��!
�X�`I
��:O�Yo�V	ޙ��M��nw�Z� nK�~W-o���&ߜ�U�;|.�����'V�D@� ʅ�߃p@G��}Y@%@��iY��d��xY�So+�˭#��B�ª�A��Io���ݜnDj�#�!^½�,�)v��25`]P�s���g�% �న���#s���"j	�?ط�M*��&�w��2R��kb����-����L �!<�n�*+.�R��Y�{�w��Jp���+��57��vt�^�'d�q0�Usn��ϋ,�N�bE�L�mR�Np��K�N�Q��w�f��)��q�%�yy��_�Ƃ�6E+�.��G�l��N&�4��_�O�C�	7�ܓ�w�>p: �B+�/�    )��k�_Yg�Yi?���ޫW�>�d�:t��4��nn����m��NmXZh7]-�N1�(7%!�G�9~�(�i?Μh	HO��/IDPGD�Xx�^I7����9\�m5(�-;	���Bv���fƙ�f��6����;�$���h�;7�{��~7�BY*&���<��D#�I}�w��Ӡ��|c&ru�ݮY��鞻k_��&tי��� ��͝�1��oב���$��$�?�G?������C��Cy�aK0]�!�E�(�#��Gx�����
��~�Ol79�r����y+�?q��v1[�{f��k5�����?,5��4�\^D10䁲�E/td�|,p�Í"���]2N�Q��!{����\9��.�z��]7�f�Ĭ��"F�%�*��E��Q8m�o��G-� I�n�(|���"���Be8���&8�pN!?G��䦼;��mey!�1MEleݥ���2���ok,#)��ħ��;�{0x"�ʑ0���]��*�	��i��������r;��ŭ�w!_�ecE�R�j�]��XY�u���[S@�%b�ehԝ! ��O����&���Ѭ�߽�,ڋ�C+�����z��#n�Kd��07���_��Nɰe7���;�����_I_����@'�:�
��4�N�сpP�|��#�F3u��o�U����	��s5��Ը���ΨM2�ɋ��b�ʷ`�?>:���p���sc��K�Ea8r�n��@��5AK���Q����Y핯�~3��p���7W��d\���\){=�ባ�(L�S���l���F>�?t���릹W���dFGu2���E���{g1Z�J�Z"�������JQ���<-��@��s�D�BP�H�@At=vx����!*'	��^ȦW�ؚv�ڗ��v�Jb�[�ek��6m��"�S#U6&yL�S�&af����M��1�{;����EQ�Q�%��(�:z<S��1�b��}��H9M��_�@t�eq�����i6�m@Au�Cn�h�����o:��,-��� �&�@��_�?p&�x<}�\cv׻$b�isC�`��lbv0訛��^�[��7B�L1=c���e�!!
3���_�.���e�g��ŷ]�(�B5!�ȋ<!��< N�Y�9�n��1Q�l���]�wќ��Ψ;\4E41P�s�(�~���\(a~\=|K�!�G��'��ܜ��Mj���:/�3���b7�j�ʒ�C������z�Ż`�&~>����pyA��댖?�ȢЎ�IX`ч�	�{�����3���$�fzǭ��#t1�&�{���x����]-rS.����Qx��q��h�+E20�!`���[$|-,�K��AH�B��xAM]r�fCݬY����1���,?*����%-$�fd�)_9ׂ.�mY���pւ��jmgX���	N��sj�e7�I �6���Y�n�م��lܦRˡ�-��z?�ܤ��U^,:|s!Q[��n���	#��M?�����vàm?g��c��J������v���>1�J�i{�kw�%�	��E���XZ����e �?����c �V]5%y0��&��[d�_��G�"��E���<j�`�ě;zQ�9�:�p"�5���ʵ�k ����kc�y��Q�	���{k��bAZ���[ٶȊ/0�&3s>��fUݙ���̄�bse�>��ӁuU�x���B�D��iL LGi��a�o�������lRŊ�D�/�m�|�\���Ck�ى�yV�'	G�Z�|�ܣ��'z���L��(��0	�j���T�w�$�#��u���-$$J(��޻��d���rmG��e��˶=��P���x0�T*�ɸ��<�^�,��w��їޅM����3z���Д%0_w�������c�'ar��>��Rv��}zH�XkZɔf�������a�Ղ��5�\p:��q۶0Kr�B�q׿R�-"'��?��"p�1_#r
�Ľp�	l��2�2aq[\�=�f�>�}; ġ����.�Ss���z��@	3	`���C�+q�c	�F��$R�f��?ts�(�B�
�$�d���,�Gժ��QJ�a�89)�f8Ϩ�K�Z,;�6ÛBkî�M�%,��/3.�z��������~�����)�V)���Kj�SŒ1���6�x�΄��0˚cT�ۙ8M�󮋔9�C���Xlq��p<�^���GG���A0�^F���A��Ζ��[b�\1 �J@V�Hb>1N�R�����J��w4�;��@P�w����ċ�� N��V���@��A6\D���rqn�&z�q��Z�}�Tx�`��cM��B�U.:���<)Px��X	(����f��Ŀ�k![�X3�4zG����r����v0��&P����ܘ́�4��N�C��bn���ch1�y�'�N=��#�A|�	 ���'� �-d9*e`�/�F1�I;�i}�;�y'KgF��?�8!�M�<Չ�Z���F���@��̾������W%��`�LL���}s�C* ��)@�@ze���3ሗ,$�˸a��)�0�uv�ƾ9O!��po�S2�,jK@D�A��$3�ho��A
����O
�ІNI�&�B+v�E^��Z��b*����B8&[�����f�C�I�!kE��9��^��s�J�_^~��v �.e�W?+Q8yL��"I�e��M��N;��wk�"H�#�Ms�M	���2��u��V%����@�!���O�Ǐ^�Q�)qI�3�$�B���Ф?yN��g8gog�����yDx�fy6:׋V�P_�a۱�I�Xm��D,�� ��7�!���=I�;��j]�?�����_bq`����6�9s�~�����H�挋�n�n��s����G��@���塀���[\�hS��>N�����a("�/�c	x��W�p��ϡ���n�ՙr�C���~�&�Ƌ�6���Bu"k���ԙ/%²�q�	���8�D�U���~�2�4P����U�b'vDq
d�*^�W'=�8*�c`��h��OƜ� cp$s�XPi��*0�����ug����<�"(aIA�����%�S����ܥuC��n?2�D��c�+w�X��\��[z��py�N��d�~�è��* ��+�v�P��g4G��.r�M�v�߼X/G�%��t�z��mB���f����W� 恠p���YL����K�"z:Ș�NW������ �� ���S05\L�f�}��K��
��t�(9��it5��lݵ��>��moa��F~����@��<X����|Ex��#tÉ�i���$`�|�G	u�Ww������#f��mG9�|U�Hш�B$�ӎ�����#��(�;r�]d����������7�XG����K}�Y�Yto�t�.��eo�!5!�Ayq1��=c�8����yr%&��~�/���s8N
�� �e�O5D�pD�%�zT~��F밝o��^6
č)d��7�0m�e&���	ֿS�AwNI��l��58��S���8���W�W߿� �,/�ZB��w��/��:��|��|�e���!q��L���e��,���f�+�Sd~����̟ĸ1�@���б�����Ph����_����b7�����47e^�+����_��2<�װg�:e��/��$��b�/3Ą���uN���a$�����
"�D��@\��k��B h�h��rUZ$�~�*���T+�c>Y��ځ~%��:X'��p_�;z"~�_�`~����	�y������Bfۙ�AR�ƕ�l3�[n8��ץS^�N�����y����Ȋ��V(<���"�E�E��cj�=�a&�#A،z�3����#>;���;g��j�x��vL���/�K/�M��6�����W���:3��7��J�j����o��@ �RAS<��2OU�#�=r�N�~����Z)�7Ӫh���O��z)�|!7|�Z�Xx���5t�g��7�҄xR*�?Pe1"rN@    ��;E	�!�<N������:'���f�Tnvy���;���Y�l3��V���L��_��P��}K��ޒ��(�ARp��s�F��X�9rH6gF}8��t�)�"hjK����^k�hiu1��D�ı:����電��B�B>�	�	=g�kd�p�M=���1'뭥��E�'iʷe�%��Zws2=xG��U��I�F��ϴ��ď�7D�ԙ�x�C]As��`@�鲴�ݙ3s�PO����Ŕ����H��(�6o+e�yzr���)��	@&�/��y���;b��c������\ �m�@ǖ��I/f̤���@4�/���gc�4�y��>��m�2���4��4�1�#\`�~�&~fWq�yd��lg&>�K��uC��a�{iCܯ�e�\;b�#��,˕���|��nk��Z�+Yp�١����B>�xO�h~�x�@������a���NQҟ"�v.-�Q_�њ\ג�FA���龤�b��M�t��l��Jٱg섇��p�?9�Ǹ>�D�9&;�Za���+�����p�!䚽zk~(�[�P*c�� BF����ƩV/X����=��4lJ������ C-��=�ş\%p�X���k��7��.��^j��7V�4�J�w岤�BQ�;rT��"9_i��D<���.����(C��xD	��?��%�N���.4��ջ��)Xi������}����Y��gt���T���Έ�2�n&�%<wm`��J�Q�F��ԃn�����
�ymg*&X��Ro��~��S)V���������ɯ���m��G�3�� ���6Gv���b��W��zL�����%��;����E��\Ϧ��kW��*���)WKlL+m��Bh�n�q�B�+>pk�9u��<|Xc��O>������[�>V��W=���>]��"g�V�괱sdg���ʬ��W�Tg�H��bbi��>D��\?%g�@"�\%���'��[���K�����%_�cN�	LG����ܬ�A���]���n��ͩl�x�ĿS�8��Bv����C������/��(� �T���s}�:�xػA�M}���r��G;��6�Z�s2�v]S�S�XTu�W����a�1�c^�z����1hmB�,a� �}wp2z�Ё���qק�����u'Gc���7�,��Ոk��x^��D�"5��Q�$y�OW�"�6�/"C-����l~f�"3u���w�>��l溙7n�X��8��I�4;^b�Z���55��5`st� ��c�o�3�<�i���OV�q��q/�Pqt��g�gf[.LY�:;�x/��ݿm�9�Є���U6-Z�tU$�kZ�e�Y���>8�F��0Ed3���H��� `�g�^�/WYȻ�w�|��ϳ�e2�9�|�ƜL�+kney?&.j�Nf��N��H4�P	?mQx��@��3��� fCAC�^�K������dL�+�v�eӤf�0�씫,^���8����O����9z��q��	���� �E=�������A�K�"��z�����sK"�DQ/�5o�i[$uz_�8m�k��� ��fv����m�'D��}(��h����IFt@���?�[��J����q��ɤ�S��;"��f�w�պi�n���V󭿦��	;a���c=�}�}ȅ�E枆��O�C<BX�����.9Z�W�2�2��X���Y�נ�������%����o6���в,߬6?5��&T���~Hm�"	�4M���ri;��e�b߲���*n=���m��܊.a�0f�h�n��w(щ� ��	�`DN�=~�X���dh�>Y�S�Q�֟�Ot/�sŴ[��¶ֺ�k
��J>�i�/˘f[5`�|��}�q`K ���/�/�/����(Ti?��<ñ(���S萄g���ig�y].���������r)WD�̄Um�nN�kqpI��E4���S�� �"< β�Z�b	�Tx���P| "�{PX�^�����$�fɕ-{39oE�ۑ?��Ltͳ7���M�g%tv�4gA�Z-�A���./	�0vx��}��;d�/^�h�!!�}����@5W���/�RU�ڽ��)�$�7���؁��ܡ� ���ӟ���KK�E��U8��3f�5��(z�O�G�����x�Zn�H����:"�n�ڼ,"X��h�N���`�Jzж�����CI��8, yQ���w5�"QvbĞ����Ͱ��W�ў��B���6����\%|r�����.�������i���������/�o�u�<�kg���O�r�c]��<�t�Pͦ��Z_���1��f8k(Ӝ�l���4�>rPLaQ�����9I<Hr�<��,`T��@lR��݄���J�J/8�Uu������2��U��ڸ�G�f�WG�υ�� �=	�8�l�j4��s/��I�h�s�8> :^E�mu��MD�6w��]��f�����h������lx�i���٥-h��$ȁ�'���C@8t�۩��+���
 ��meǨ�_/�VmO�,������i�(��ڠ11f�M���v<vU�'V���4�h�÷bA����J�O4w �t�����3�b�� _��>���9�أ������D��<fW"�%��v�U�ؤ�7$|�(�Ȟ(�?���R��y���Ree8�)|��(��Y��/��i��Ԟ-� ��ڜ�ȋ���wYY�x��S�H	ӣ�Q��S���Գ��P3��`��I}�?�I�>O˶�z�1I�S]h�l0�~N�}Ow6�&|�%�<��n�N3zN:E��IU�[��TG
��}�I}�7 ��0
pUO���=�T'{�[�yf�[�̅K��k_{���KuB���f�Ie��}�]a-�?����/��,��Y���P��)�}�W���PyC����D{u�GY�PX�<�j��!g��&n{��a�l7T ���R7�aQ�׺)����m5��:4C�T-���N>h킔�S�9���N<̰����f:�9T3{�X˔.ewQUuq�>i��E1� KYd���[��V��H�g���[�;&���e������m3q��j;�}'vs܌��?w�v��[U+G��d�u��^�������ƛ�ޛ���'Q��-�̃����l�pT�_<�9J<Pu�|��Q0�WG����rGcݪ<5ǖ���x"��.�in�Z���b�� 
Q�#:?������oGoi��o�(*�ѩC��>ɑ �駏6���|v�-����C�&��]��m�w{�19[qK���5�4T�p}Q��
�s/p����-�G��V q�]�E����Y�E;��5}m����E�;b<�.��L���bӕ��ו��L-9��w�W�}
��ٔ?#>���>$�����?H�O;������,�@��7�"����h��F��<Ό�Z�/;����\v"!t3�X�����g�a���\	?۪���=�cz,��b��U{Iy��Nl��FF�LBT��qr�j�N'~�P��{�F�֢C��(��B��'�~���c1@1�R����pz�r�V��v�okT�ǵ���i���|r��u��w�
��p2S�e��M����I��D��}�X�9kᥕm��ٳ����FU;~��nMh[�bTݍe�l��f�}g����p��X����~�y�2�5�(�����w�]ZؠD����[ΜT9^���64�i]�uy�����ݰ�&�g���\Y�^Fp����ۉ���M��f�[{��`���4�B�-mJ+;�vRGYkAJOEU�-4��$t�/�#U���Ɲ���C"�Pzf�6�_G?��A瀅��~���v</�;�A����R&O߻���x�{�p޵e1ߊ;oq��������ݵ��wB9�)|�l�� ��́t�=����	T�mȧ���B�U���̒ �q�i�&�k�6Ť�)<�7ҷ�}\1�!�[��H2�c�E��A ��(    t��V�LP�c�|s���\�h"iZx���@��j���f?_mo6e��NM���i��ʝwT(x���0++�Q���,	�3y~����E���&1ģy��[��8q��)b�m�s�;I��kטlu�̹�!}�Xb��ޮ�����A/���>�r � �npC{��x�*!_��A��yIh��8�|E��>hdkn����Q�f����͊��@ݎ32a���R_����H�N2@"#�J��6=N ���fG\�+�$�mP�����rs囪
]�]��\���ԾL�sa�F'}�_�G�Gi���
:If�8��C�V@�� �2t��#���6!H�!�F<�l4�}�rckgD0�@����´j�e���Mx�Xv������UT���X�~�]� E���@l�A�BG�)���qJ��OԬ�Mu�:U�3��~���"��yK�{�2�p�ݰ����Oh��A������|��XG�(z{X� �yM>�2?�����P�VjNo�κ1S��"�8\Dsq�\8�¦gK�ݩ�<A%��O���o��tZ���o�D�&��X�d����D��M�7�p^�����Eh$����~8'�&>
�"��	L!&�|���Ӱw��iv�*R�qЃ��q8M�_>z�U�rM_A��iӍ'ڨ8�Y5�\*�`������|��&��7\����(]��!'G;�t� ׿�&5��P:�-�rP=<� EG�� <�x1�������������.�'M-2�Qs��̊�{�)��o(�M,&��Ts�Q��	%Q��A�!@
�g���'� �����gqp�@��y�k	�=�"����|V�Ub�7�d��ͤ:o��n^���±}�����^����O�?�6:�?<� _CI� 6���4�Gx�_fF3<>u�)�V�FJ$/���V���SJˈ������0E�g����$(`���ʇ�
TBTS`�7;gLQ�������v�E��w[�0V񑉅��1���6��<j����
;EtpU��z{�1$�8�z��O�M4ƑF��K��<,J����j��#S�M��;|��������9���v������C]�6LPX��PO��&�G+x�ᕐ�^n��}�K�T�:h+�T��w����Rm��Җa�MQ����'�+v��͸`!��TE��"c0@�>O�wam�����q�K�� �"?l�Tۯr<�Wd�H����� ����|�
e��Awޖq1�=5���п
uO��C3�E��_����v<	>(���i�u�쥩>)n��Tכ�R`�%���x-+��2~o�UyiB^n;f:�@Y�.�A�懧�Se�P~��O�n�Lvx�"����?�3�<'�{�cܮN�ɋ��*�m}�R���g͔�k��*-i���5M�r�W��G��a��B;��ȟr��ɣ�̠�
(�R$����ń��c����c|܈Fi��d鳕A�|v�7x3�ө���E����������I� ς�H�:Ϩ��H1ώ61oV\��k��2��6'�X�2Uw�$��i\4�j�k�U��
������'�����H�d_��{d��$�Xp1d�A?���
�>����Sr%)k�4�%�se�ǒ��%#*}f/�J��
�^7�)������Z@i,�h�=~����gBR �C�]�V�+Y��ˌW+����|X���n�i���76{U�Yb�����IJ��G ^���(�$����<�p�{���������o��3���[�'�洭f�~3	�帴2])���L5�U�Ҍ������(Q��O�!I����u�|7e��<*6�A`��o�fhģx�d���N�os$�
�7��q�����(qv��z&�A���!d7��?9��4��$ڶ�xb���b���.�J�Db��U*VӢe��ܯ��n�Ć1{Ip�xX/˅��T��D �-��4@����P$�>��@7а�%1L��>g/n�qFhX��4�$���3�����=�s2�EE�w]�2so}�+�sPi�5.���w�`�A���o
<���'�*ʅɁ����2����.�ew9N�ԝ�Ñf����f/Wݡ�O�޶�F��w�Hug"�'��%���"5n��I�!�it>D��w���Dr����C1�*�Ա{M�.7e^}����²q&���,851̺g�Z&:>W��rX �����A��}��Ԡ�����st����ѯ�kw2Mm">^,�T��f�M֜�:.v�B:��rj.�E�;'��#{�\ �%���3Qd,7Х��ǖ'O$���S� ��g����s"µD�@7��,'��U�rI�M"cb��[��/�WWF�:�)�v���y���	�׍򭀡Tn����bTy�J��mAܦsa�O��i�/�#%^��X�"�-��'Z<_�瓥����RvA���F�?��%J �%����ӋB۞	� #���M��7�ˬ �TFw�|u��<&�-�v��U��=�'ʺ`�f���E����Qkҿ�#�k�o�<|o���N)`�̡[^�^�V'�\r��/�j��ʣ$��K{%'�w��bU�t=^�#NQ�t�r��j�$7�c�� JR�F�ѳOf���$�g�!fw�Ku�o�2[��2�N���sM����7�ŝr
�Z�sgKƫ��;����F��&�/�@����{�W)x�:K���3҂���B$��0�V��rw[\\�x�8�V�v�%��D1�d���ڭ�mv�l.�����waQ��*?޳��:�d	�T(�x�~�38K��@Cx��3[N�8.��%kgm��Ξ�b�E�/ZXU3�>���amRcٕP�`-t���{�Ͱ�aWzIt�@���>�h�8'�w4����7Ӡu�ʼLc��3�[������+k��.�6cL)Y�)�[v����p�F�s���f����x��x%����V����P>U<�nZ\��/���F�Q�Wu��L.E|-���F��[��o����A�xoM�'�{
��f��X��9����.8� Zr(~�t�2Y�p��I��|�����A���=`�9?6*%�y�Mh�*ĢSm	+c�d?C�����r@��'�k��;ߋ@� ������A�i,���o֖���~�����Ԓ+�>�dM�:O�wS������f���I~���O�[�Q�",����OA	�����fϨ|~����a���kIX���6�0�Du�Zrӛ�Z��Ƨ��T[�on�Â�?t�2��/�c�3(��,X9C��`���	eE(.����P��_i�*㱤��!�5N*ķSծ��$K㻙���]��rqP⩽���h](/4�>͛�wVB�@�� (C�x�nbX��*��� �&���P��'ok��y������m�5�S;���%��]1>��[�1ks����ʄ�M_v���1�`���>ǲ�W����n�A��{�1,�7����Kz�O�TZ�GBe̅ڷ~��b����x|�m�MlTM��'����?gK�QC{����w0����<�q��@B�����r="�'�r�����R��kb���'<k��TN6�ҒG����+��$�V���A�����!�4�cѾaQ�.��{�h91��{$���(�yq�h���R���.��Rh%��&���:��'��`M�����,4�~$b�o�`�ߡ��fK@�t���� wg_�^��fƑ�ۃ��e�>�;7��y�{�Ȣ��,��.�}of/)�kz�c�=ͼ��$�|����/>�B	�D�	��Ea���F��ƕt��L�����ϴ:�7w�ǯt�q��P��x�2I^Vml��eq� +�.+����b�� �0�ݾp��(�)�i�@Q�Wgj�W�_��J���G�e�bz�l��+o˲ޤ�Ż//����+�/a� C�������I c����8�DP�>F���p�<L�a�G#~�)����B�9�d��_9���U�K���n��g��52x]��!#�L<�b	Ͳ�(��jI�(�O��    C`<*X88$O�R�?��m������Z�݊d��F�nU\����`�E�O��|Iyp���?�(9q���<`��P�iF}B��pQF�$�A�n�,ZB�L�ޚ�.6�o�E���a9�ʷNVc3ޭ���(�E����2+t��:I��$����C�$!�5�~h�K�+9�����W�:�ͷl�������2.c
���:�|��2���A�b�,�]�)CF�R�_ޔ��lgѫ���m�ē`&���̂������5u��]M���mT�<����tX�E��m�`>O�W;;␗3ď���-�*�yO�iG�J�����P�`aă1�zO�J�	|��b�[a�����7��+��G(��جfeߨ��rVE~�}�*�aJ��nu�UiN���g�8�r@'k���W���M��o��ND�n���8V�6YΔ��X�ko�\Q}<S�e�B.���Y�f�?������ؽ��/	�Y�C� r<���-k�U��r����cF���iM��0���-Z�=ޚ�6]̯�� [��?�����xOR��OF�Is+����, "�l����`��~���Mn׋�nم�$��z�|"�${��(v̮.���[X@�w��O�̅�=Dp88|�s008�����������HW5�6sw��F�5l����%��I��9�d;,�d�r��ބK�$z��LjxI$�2#8�5��>��Q9�S_�*N�}1�������&2�Lk��'ջ@L0Ҟ�
��w�V�f�4f���"ѫf��N���$�~��0�x{? �(�[@�U�N�TT�lIG(˧s�k�H�Fn�L�t�ռ6��4g,���\V���p�J��5P4���"�W	?xK~)��H\x���h��Sݹ\X�4�=�w$�(/��`z�N���(.�c���mq[�ņ�'"��z�W�ZCӒD;} �EJ��S��$I�Wp������]尥GL�*��-�j�وRTg��^��xa:w����WY���܆]e7���s$�F��Q?���	b�<��Ca$ 6y��Qxcu=�m��՝��|�R�\2�'��$�t������MS��1}�����e:3�x�˃��^0>p�
�1�m�d�ŭz[G��ܖ㻾:َٜ��OzK��]��Ѻh]EN\�D{��\ `�/'�<1{(`��5�u�>�q�B�J~�`�VU�*x���W��]�ј_J{��H�/�u����E�5U"K���|�B�X�A��on�����!L�RL��Q@�i>*���IA�@I2(a$��M�
;��ٖ�'m鲩��z��-��՞R�쮱�[:�1�����8�@�Kx�+������p�4*�����(f�$����K���:��=����΂h�X�y}��]:-�p���\��xb/����f�p�P��%����=f���B�&���{�*��P�>/I
���|�~n�x��)ٍ�Y7R0+�-G��bv+ߞ�G���'�.?-x��U�Q	�Kv�?�)���������x�~�8�l(	�ad�
�G�3v���L���)���)�T�n1SS;�N,>�g1�yIf���hv������0��;��W��?���4��o�~��>�� 2��$.��(�yJMV9��Ȫ��(�U~�S�I�^3�����l�Δ��KaY��l���J<uU~ka~�@E�7	ᷣ���F1��_3z��v��X�S���c}a�k_�D���Z{uf��H�\��ݡ������ ���`�(<� }�A��Ba ��H
���Б/j�TYP����SÔo�Kǟ�f�n�Y���n5;���2F��a�d��'��JO�$P�����Pa��+�ki���� qI ���&��o�{_w�j4�n�֥>�'u�mu=�.���\h��l�'O/g^(S�?<�d���#֡J��e����o�0�q,�d��I��L��ѽ�N5SB��άT�ņ����Z�]`��9Z�o�b��F��4h�1_fs��g�f��@�Q�#"��>�&��P��A��,(+xn�1�5��kk�ޔ+J(�R� LpyD�v'�fj��Eku/��)�jt�`����I�g(�f~E:?P#ё#�A��P
�Q�k��Jo7�xލ��:�8Yi�oj�YYe{�����Ż=�\�[I�Ǜl���M����� �����A�1�W��%�~���&�����ٙ��s&G��٫�c=��9�Y��}�����y)h���� �A ��O$iȜ��81����ݶ�C A2_@;~@���Vv5��<gZF�Zi����D�W��Aݗ���ǣ�ι�D����l�	�׶��}�	�bɇ%�*�E_ ��W�g}�Ŏj+Ϛ�z:��T�Vѹ�P�mm=�/�&
F�uk�^�O�83�����V����_��o|�6�vz���C��
e����K��9���۝��)��lU��k���\�k��Sv��6-֎�n!9��H�
4�-���#n�K��I�Z���!I 
G}�Y;A�� �bl✛̭��j�k�L��6����Ӭm�5W���0I)ˎ,cs�!��-w9[��]�CzO?t(@�D����b��WJΈ[��epG�p?��ҕf�w{�Y��"e�%��c-Sa'/�Y�	�$����O�ѣ}���H�$�w�~��P�K��TV�������9�S�q�X�o�b�q�m������+]�B\�r�Ց��[/�p4��ot�-���~0H�@I��[zr�C��i����@/���H��F�}2��m���9�=n�=�RY�����`��bf�x�ǰ��E�2�a(�A�أ%z�H�ر�E79�
�/`��v�yl��~�'�Gu���~h�%�ܷ�N��Fȴ��0Yjq��=���uKD�������Q���R��g�����4�%�\Ůᡩ�z��i*�(�q��+�X5�t�� Z8v�*��D�9~3 u�:?5m8T��zG����囻��H-mrU�9Ge6�_�&o0�ޕ���v�.�$!��i���������tQ�7JZ��<|�;��8�����J��k�C���K����VS�v5&a�;Q�$���"	]�=���DMp�K�b�1t�t�~�#��>�gP�q< ZK��S�Q���q���&'�R��LG�+W����3"�Q��#-ۉ`��?�����3��f$��܆�%F~hF� ���������_p
y8�I�;��N/xIN�F�粎]��0qV��.��%��#(%9t&P	��ߜ 	��τ�4h���T�p������!yTܢ��eҜ�cܬds��<T\Z=�[��y��Cf^�o���Q�I7[l�(A[�����?�}C>X($�@���+%���Hu�c^d�/��5��T�Mm�x�O�c?a��>e\�ETc4�#���v�F�7VC�M��'1c�!X.�(c�*��1$+@]%�<�B��D��3������궮����m2u�a�lE��pY�8PM�����q����U;y4ip�Q?���$�yT�14�`��|�ۑ}R][���%R�xd0�/��."���Y����>�㹂7�axA��d���5�C�$@��܇.�|_T����nT�E��V��I�dP�8�	�|P�F����n�����Ȏ~�$�합?z(���V�u^�C��(�v���Є�dJ���ѷB�>�1�%��ŌFG<���+TeTa�(FqU�;\fh��"�/.��ƃ�a0*Z�5���y�'��,�,�
m�bx�i�cf@<Ѡ�("^�������>'Ry>=�r;oV���r=m��;�a�gTA6w ���1�ka��n�����Q�V$�W�;u�x�!Bg��d�4�e���z��jLƵB:�NJ��HE_#nN�6�n�rϴe�Er������=1?�돨��&�$���������
C�O	��^pB�x����QK#���V��v����~�ֹ/��bC��B���=m1X�     a�j��Qx�fCeƀ:� `��P{�gH ;���@{�h�]���L�H���w8.�[s�\�sc�M|\MR�$�
���F]�2��)�gZ��� F��3�aX����<mo�I���c^.���J�FfuO���d�ɥh2_����G?�̩�5FM�Y�ք��/P�E����Z"���X6���{�ơ�.6�V����ۍ�9�w�ͶnFe��$�녍F����ν}(�����u�($с2��/1�/���i����iG
ei�'K2$�__̳����㝣콩���"[��f��7�x�R�m{ࢣx���нv��+8g4X#7D��A>��yhg��W=<��n ��/r������M>��Lƨ#��3�3g����6�<lzE�)T�k�e��\Uk��9���2ü�� �h��l;ǡĈg)��I,L�����r�C�\����C�7t��ۅ.�V�e�a�Gݽ2_��m��]�b�d
g�DU��}�q�X,
�4C�����G`�+P�t>��Ϟ�-���oGky��Ћ]�_[c��O�Xx�!�y*��
F��0������O���H����?�\��-�����4�z�6򕵘���ג��P�$��@����G�I�d��IZ�*���X���(EA ��?��P���C��K@a�����ĆY�l�G�����ut�wc�Ү��.�R����[z�G�?ӻY8�I�n�l6\�b����#��PX���~�I���&d�zF~ƙ&���2M����o�����tf�O�����6q5���c�݌���Y���3>E��P�� 2�ÁhT壳�Q�@�A7�GVk���ru:N0�ݹ'�o"}��A����eV��Փ:���\�{���(�	�~��#��9����:��dCkaQ��"#	�(� �/�1�������<.�i�#�EI�	��+��=.��nB�&U�X���a��������ȅ��!W����2'����g����id�m���L�Y?���~�����)ݭ����#W�FGk��O�ƀ�6͡Z��GX��[�q4�Ͳ0�ݏ:Q,M�č ��1(TP�O/K4:MYX���/��K�VP�|.�+ȯ��I�#"�C�zK�Jɰ$�K=�n5�3Gt腒 ! �����N� �i��V��)L�>���7���ۣ���ާ�S��ۄ�z���Q��صK�ks������0��s�%���?G�I�����@Go	xw�˜�X�\Z*a��R[�I���$��B�k�et��գ�#���*�a[lM7��j��L�ߎ��=�$��b ��%m�:�ħ�f{es>�{C����w�j��7�B�;3r���l泞��ץ��	��y�A]��r��s�� ݨp��{�ġ0�(6�������)O��s���4�mm��8.�I]@����ۻ��ұ���3������AL��A��hC��<�3������(��(��<���i&:��N�_��H��k�3[U�[��r�k�9��]R��Y�U��Vp��iP������n �P��Fo�s)z��͏r�v& C;�Q8%�$,�K��F^.�!�e�/��]7����ż�(k��~����R�]�?��鿹�@�R��?a~�Ma�u��_��0`JH�,jթ�t�R�x�%JN�j��7ƞ��,-�����n̮l����p��?t��)
L?���������'C�D�	�g�,��Qx����m��R����H��zo��I��\���e,�e�QN՞	�iC���>ږ�%dO=�ٖ^1����?`�+F%;�S���g���p�H��[���ӫ�L���/9Vk�jx��u�����Lʜ�v)�ʟw�Q����A��-s:�(7���nmTCr/�����#v'��^qv�H�/m{�lu�W�Ɏ�Γ�x�xs�A$�9����ġ;���؉o�F��)����,���v0z|��-�n01�qAL�������(Y!qR=&g;a'�Z�l2�s�4�\�F�M��$�g��C�W�o�ax`t��	]@:���{D�����Dj��q�7cQj����ΤX�͢x�.K����m>E�K��!���
�kA_���a���%NR$���厏�c8���Fy�Gtz��Ssi��q�n�����c/��uo���&N��*���w���&��Pns�)���Ov��\(��3_���.5G ���58��ȗ91����-��G�:�|����>��5����Q��w�#c�<K�L��O��<+;=d�@�eH����7�-�eAI�CbX����v$%��*;��s��Cz䄫�b{ MLb��ê�s\����8����k��?�ꡎ�R[��!8���~,� P�  ���T�|v���|�LO6�w:=��tz������6��q��)�9	B���a9,JB����<h
8D`e!E�1!�qC=â� �p�?mk%C�/݉�3͌g�83�R-)��nd�}ً��*k�}sUv;�c��~՜N��~PUBy�7A�M���y��I�j�F�x�i�|Zh%�b���enxv��#�)&��.���2�j�bS}���� .mK?l����8��=�����B�h<�E�`nbX�7��	���k���!S��j�����ja��b,_�U�-��\7����҄�?x�or��>o�=
nFJ�э�|�C�x�}��(ܲ<��'v[��F���ڛ�	��D��"��,����Xx{�c��n��QЕ'�a���1�Hhg�,*n���J$���N"��	���/�\AԘ��N�n2�t�	6�MR]�wM�Bb�VLJG��mwF��
HX��6����4����c7��`yT�� 9���?�?�FG���d)ؐ�Hg����D��7��I�E�.�	 c��?�D�Q��;�<�{��_�C`H������`�q�{��\��5K�鸴"U�%�5-��ُ�{^37ۥc��&�	8|3
����/_j��+J�`��?�D2G)/�*�/d� �$��MAK�I��B9�6tZ����){<��䜪�OG���d���{�y��/����?�ec����)�D)��7ޛŒ�* b0B����)c�-DV�&b����)�W��#�z4����ձ�ewk"mʭ�l׭@@a�a2�'��}��?l����HH�⾘�4���H.x�Y��T�pǻ�xoH�f�ʕ*�.�̡�L�������tl�7�����s���4d���&;
Y!z�i
9dH�3�uC0�yVr��Zh��e�]����i�5����~�Ɠ�3�p�\3�^K��R��=�+�?[~�C:�� =�+�_p",=L����4ʂ���j�휕%c4o\�F������r{�0|���W�'-Yw�I4���7C$cA����2Y���
O_�Gi��6�J��R���<���D�l9�5�~ʝt<��q-��΂�!��(�#�T��L f	�c;<���b�i���G�OQI-w�Q.�(,�{���l�b��b��{/N|R��zR�|p^EE}I]�3�����< ��rb��L&8ヶ��/�y�fCy$�v�h΀j+���[Q�J����}=U��[4R7&����c,�f��嵍�jђ��d�5d�n�=@�!�|[�_4ڊ�?�Es��y�l���������d2��{��1�*�&}�,s�7֒�s�d_�nB&ɰ����y�a�t8�t?�7�/x�A�f �9ó^?2�iX4�i��t?���J,u7p�@�mn�����`՚g�:����Cj�����=0�@%<1���A�$�k����W}�����)��iOZ��\-�ᯌu��N�N]{ƍ�ٺQW}�,}�Aۛ��a�� ��EU�7K���=	`�`��l,>�k�5v�EYԍ��g�:,����z�sdI9�RE�|QN�&�=G��Q���O��G+�eP���T�1,IPJ�)�Ae6��    ���n3��V��6�v�6����OD��h%(�Z��1�\�Ŝֽ� �g�P>��M���K�KT������s$h���D �p$Pvx�y�}J�L���^$�������\.��޶�3��m�aJ'�c��N1xI��ҍ��J"O��7 D�b�mH�t��P2	z[�}�E.6�M*�FFg��L��J'W[�O��������F�6�CUǥNB9�5�����<�|���W���e#(�����$�?��ԟx�l��F/q����=��Fe3��xd��T�z��
�p������6s�pP�J�!V�6� |�y�!�F_
�����T��/sʺ��k�dn㗦�Y��/�}�O�i���j]b��LY�.^��`��M)�&�w�)�R�o �Q��ώ34ϳ0��8
�<���UK���s����ka��[5�-$/�bd_�p5�8�p#WBW�����/-*��q��|�h)��������,�j0m�g;vumr�ϧlm����{��蜍�ӼO���UN��&�-��v�'�k���Q;�Ó6Ԁ�E{%"�^+�� $���}���m�/Ƽ�j��,��[���c�*�v��M����f[o֒(*Wm�c޵u�in2���4�	d��*��d�,�:M_����ΧC
S^@�A��d�wt6W�T[%�g���:���~�+��:�m��&ը9�Jqg�7ER��p{�d�WO��g ؀o�7*2�?I��^J����~}��x�E	���L)�.\�+eI�JN����F���t����%��uJ�=P8E�(������4F���x��o$Gsh�,&W߇)�3���M[�i�f���������oz"�^f��)</��e�M�XƊYA	��?�=�i�w?��P�L���޻ ��m
�ZC��Fw	��<Dwf����Xmw�É�-�&��Kw��V9�J2�����c���`O	̗��N�KT����8�� �T��m����l,h��H�>7��]�c�?ʲ�� ��x��T��ǗK���7IW��
I��l�es69��%l�P�����
$ ��@�R-Z��x�N��9��\���//�ݘ����Y=�&C^%>�\,�VΗ%p6�H����o��9�30��Z@#|`�2*�Aϒ���/�,��F�2*�j�Z�~K�z��w�Nijc^
A��\�s��g���v����'nT�g6������H�A��#<~pAA���58l�KPR�ے�q�3��qI-�=W}N9T�������}su)ߚ;���kx;8�5���D{�e�?XX�T㛣�G~��ۢi�'H�о(�h�{yQ]�$B��ȫ�r�n�CwBg�F��+�:5k
K��rz�9d��%�l�����:ʏ�̐CBㆣ����V;à�
.����Iܚ_0m�ٌ���x�v��Y������$��N;�Q�L�k�a-�T[��J�`#~̽4�3��U ?��h=`����"�����.듢�V-y�ZA���d�4���m=.�d�͙�:�j:�W��6;�H|����##�:� ��B��ݖ#I�t�< ���Rr��]��cO���vCr��&}��⸲o�z�f���i2ù�2��D�n:��r��6���4S¯�Χ���8��A^�Ǿ@�T;�=��JV��ku�����-��<�/�-�)�����&�9� {�3�XF���q�~�3H'����#�W�%Q���/ʶ�K��R=/���Ra*^zg�Mw��%6���\D�Y�V�	cM��/5*�V�����n�� ���n�� );�����&���'UlS���)�촆X����(qV&��E��85�Uw;s@�AE�e5J���?IaÁ�C7<�L(}Aq��( l�4 ��ϝ$=9�8�|�VGa��,z��D�VU1nn�n�Ub?v��3�ˁ.�62/�j����B>�a��	�<˳,����B%� )��G�߄	�M�nO��q���Q���Z��R�e�";ָE�ww�g�ք·�e ����8��� b�߁�EЊe���r�U��Ӟ�oFĒ��:�W�?�n��t�xoM�]0���o9/�w�#�I�|�-��ٳ����@�_<�p�r ��NJv1]r4A��$ud43,�63?tBcD�v�N�Ӝ�#��'bhw�x$�6&������֫v�L�TB��c��Y���v����,M��k\�E^�a4:l�ѡ�G+E��~kǽ.�FT1a�5O4�ᅦw�6����p�zкM�8z��>f���Q*p��DQ�-��'I��9XX<!�ce����D*����;`Ǹ7C��K���y�ǻXm����
v��nyBA �L���H5���+�+;Ґ-%�i� @��ߊ���;�Ʈ�s�v�XOٽ��]h�^�x��˳h�y<ۭÃ�9�R�Y���u�ҡ��'�!!��ݿ��x�C��В`gP�z���pa��wu�)����#�e�K���wܞ���:_�l�M Fr��,�����ҭ��G���o��x��Q�d� `l ����pҹΥ��6����k̢�5�'�a$.ut[J�m%�[�,+��& N��i:4 �A�OFsKuh |���D����	�B���w1=���D�lW7�E��Y犣�ĵ��X�P��zIf+�UqrxIܗ����Mr~�#�ñ�����E*�D�)z P��3iWܗ��:�E���`��n.N۝��A�����y��K[��9C���%���;~�����ޱH���C3���a���Z�ݍ�w�m{��P�o�G��})�/��[Vz���&	1�/�~W� ���6Z���+B��Ey�X�(���C��}A~�p$��<bP${�DX,V��(�kk%R�X�8��<FYGʨ>܏X��u�.��1��\$�癇�T�����K���T��eQւR � #�W�J&`��^���m��b\���9ƕ��ݡBS#�&ҙN��v�.���C2Y��?�h_�@�)����1`cG~qа�Y�Ͷ�x��#{�WE��d�c��+f/��(^ף�z6��
_I�R�pS���/%��̀lz[�G���+��r8G2��!Iz�$��+HS��Đ8�1�7����6�}��3�8�y՝��Isp�`ֻ��5�#����O^�C��.Ot��������6�	ʃ��ӽ�P��z�9W�PA%��Z��x|�Nۙ�H�	C�G�e����jܴ%&�CN>,�9RїG�]�<���`
Â	z1���@�Mx��,Hz5�j���n��\V7��6�P^f�~u�]��c�rT޴��`��=uK�ЈC��5E��S���-���_G��bp�<����bTm�wR3�����<.��Q��1�	�p��.M*�TX4����YО���/%�MB�� �p6?��-+) (���i��B��k�����8f�K|u7m��9I@dS#T��)�+�r�W'�i��	Px?KP��S�0n,hw�@݊�ߋ�@o�E���`H�/��8��c�2ն�/Fs���я8��jq[����X5��q:F�q�#3�)�n����0�|��mAtѣ�j�������
9��D`L���"b����ɕ�~������߹D����v�^�'1��VL=^��2�6X�Ԏ��g���3$�(�� �p���l�q��n2�[��*;Iv���HX��|weR]TWY+�]DO���m]ǖ�L{����V��������B�@Py��v{u�V[MU����5�x'G���H?���UA�����8�q�b"��	߇�Dr-Et8 z������h�btuNYmM� ���x������+i��|^�V�	R%�&�Q�W�q�����Af	R���!
O�'a� �	S��y�M,ʤ>�o���(�f��^(��O$y��rS�f���P?�ԢYzp�0�yl��D�ǽ�"@�^�0�$�]����IY�K�k1���أ�O$M��h��#.��MF�jg:V��� p  �	f
3w��S��	j� ���ہ'�z�-0��y�И�����]��q��e���n����QۗSj�\nAST��l�XGJ�\O�?��m�PI��%@%����~r.��I0��C�[>#�ܲZX��H�a�jA8��T3Y�/�.�z�V(,�z��Z�NP��8�!�0O�=JaIFM\�C>�4����f�ʈ���x;��m�h��Bf��9E�e��}������T�M�K�,����NҚ�uU���pN^(����ޱ{���VuDBʮ]���*�{��Q3�*j���Q~]2�C�C#%�[螔]�C�Y<\K�i�Ѡ�y��!��W��A���00$1���1�4	`D �/ v����9�-O�BB�+�T�l(GGW�|g�$�!6���O6�8(�bX���?Ζ;�� mu�}�޽g0>>&�E� tOx.�9�]�B�:�G�J-�8��R���_�Fob��ӜK���Y��}'z���:)
�\�;M���������TNH�7葰���)�����`3cR����!�ŉ�]{T�6S���}}V���quZ;N�\ݫRfO�@���)Lt%�7Rg��Al�;J	�^�.O9)ƕ���u�پ�ėp_�B.�6{f6<SObm3\Ϩ*Qȝ��`���D��v�,��E0����)hbF@�In)� e�J�)�k&i��/�l�˜a�Ҕ�6�u�����E���hl�A�X�@d�����:�ç�}G�Nʄ핿��7����$g � @�W�4�P�ɲbN��r5�[�d�X0㘜�|O�j�rʢ*�r�Ʀ�4\�K�8O�)8�|�p��l0��oC��{�Á�7O�ƳY�A�K=��-
X����[�I�.�j�Tbv�L$�_��洟�Eƒ}"�z�::f:
s�<���l KD��pK"�c)|�Z��^�W�/:
�`T�|G�r¬�m+�43�;�K����jU$L���t��@�4���7��8�3P� �܎��L�|)P�	I�ȉ8��-(,�j_�����u 9Q����3��e ��N���ˡj��r�_\8�$���-=j_�
!�aև8�_��{s��ک=�*�kR��'�r^Mn��P�ԱPim�3T
�_{�4�<�f��\g�ۉ��h�&]����\��h@>SH�~ x�x�'Ґ���
6���⼯���@s�����:W����ey�2׫��ήq@W�\���7�5b��'��]���C!%���҈g��!��o�ˀ��h�3%�T+#*Y>fP"Z�F]GՅ51-˫�X��[!�p�y�5�O������J�y^���h���/���HV��$��蛸��������(۲��X�Z����3��8?6<���+W�fn��a*x���;�D�	���
݁=0G"!t��A?��;0*P��ᗈ|v6tU����o��Wm5��14�;��=q;���y�:��o�<�`E��G���/Y���Qz;�0�M�/���0����UM����
=j#X��
ϹQ��2����M6�/5�&/1/��|��@8U~���հ���E�o�˻W>���vL��?��P8�����9�U��M�)h;%�h.����۱�zZ��e_/HZ���ԟ�S���p1b�     
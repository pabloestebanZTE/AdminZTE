/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     25/04/2017 5:01:24 p.m.                      */
/*==============================================================*/


drop table if exists ADMIN_PVD;

drop table if exists CITY;

drop table if exists CORRECTIVE_MAINTENANCE;

drop table if exists DAMAGE;

drop table if exists DEPARTMENT;

drop table if exists EJECUTOR;

drop table if exists EQUIPMENT;

drop table if exists EQUIPMENT_CATEGORY;

drop table if exists EQUIPMENT_TYPE1;

drop table if exists EQUIPMENT_TYPE2;

drop table if exists MAINTENANCE;

drop table if exists MAINTENANCE_TYPE;

drop table if exists MC_STATUS;

drop table if exists PERMISSION;

drop table if exists PVD;

drop table if exists PVD_PLACE;

drop table if exists PVD_ZONE;

drop table if exists REGION;

drop table if exists TICKET;

drop table if exists TICKET_STATUS;

drop table if exists TYPE_USER;

drop table if exists USER;

drop table if exists USER_PERMISSION;

/*==============================================================*/
/* Table: ADMIN_PVD                                             */
/*==============================================================*/
create table ADMIN_PVD
(
   K_IDADMIN            int not null,
   N_NAME               varchar(200) not null,
   D_STARTDATE          date not null,
   D_ENDDATE            date not null,
   I_PHONE              numeric(20,0) not null,
   N_MAIL               varchar(50) not null,
   N_ENTITYCONTACT      varchar(200) not null,
   I_PHONEENTITYCONTACT numeric(20,0) not null,
   N_MAILENTITYCONTACT  varchar(100) not null,
   primary key (K_IDADMIN)
);

/*==============================================================*/
/* Table: CITY                                                  */
/*==============================================================*/
create table CITY
(
   K_IDCITY             int not null,
   K_IDDEPARTMENT       int,
   N_NAME               varchar(200) not null,
   primary key (K_IDCITY)
);

/*==============================================================*/
/* Table: CORRECTIVE_MAINTENANCE                                */
/*==============================================================*/
create table CORRECTIVE_MAINTENANCE
(
  K_IDCORRECTIVE_MAINTENANCE varchar(14) not null,
   K_IDTICKET           varchar(14),
   K_IDUSER             int,
   K_IDPVD              int,
   K_IDDAMAGE           int,
   K_IDPVDZONE          int,
   K_IDEQUIPMENT        int,
   K_IDSTATUSMC         int,
   Q_QUANTITY           int not null,
   N_DESCRIPTION        varchar(1000) not null,
   N_STUFF              varchar(1000) not null,
   D_STARTDATE          date,
   D_FINISHDATE         date,
   primary key (K_IDCORRECTIVE_MAINTENANCE)
);

/*==============================================================*/
/* Table: DAMAGE                                                */
/*==============================================================*/
create table DAMAGE
(
   K_IDDAMAGE           int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDDAMAGE)
);

/*==============================================================*/
/* Table: DEPARTMENT                                            */
/*==============================================================*/
create table DEPARTMENT
(
   K_IDDEPARTMENT       int not null,
   K_IDREGION           int,
   N_NAME               varchar(200) not null,
   primary key (K_IDDEPARTMENT)
);

/*==============================================================*/
/* Table: EJECUTOR                                              */
/*==============================================================*/
create table EJECUTOR
(
   K_IDEJECUTOR         int not null,
   N_NAME               varchar(200),
   primary key (K_IDEJECUTOR)
);

/*==============================================================*/
/* Table: EQUIPMENT                                             */
/*==============================================================*/
create table EQUIPMENT
(
   K_IDEQUIPMENT        int not null AUTO_INCREMENT,
   K_IDCATEGORYE        int,
   K_IDTYPEE2           int,
   N_NAME               varchar(200) not null,
   N_OTHERTYPE          varchar(200),
   N_SERIAL             varchar(100) not null,
   N_MANUFACTURER       varchar(100) not null,
   N_MODEL              varchar(100) not null,
   primary key (K_IDEQUIPMENT)
);

/*==============================================================*/
/* Table: EQUIPMENT_CATEGORY                                    */
/*==============================================================*/
create table EQUIPMENT_CATEGORY
(
   K_IDCATEGORYE        int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDCATEGORYE)
);

/*==============================================================*/
/* Table: EQUIPMENT_TYPE1                                       */
/*==============================================================*/
create table EQUIPMENT_TYPE1
(
   K_IDTYPEE1           int not null,
   K_IDCATEGORYE        int,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEE1)
);

/*==============================================================*/
/* Table: EQUIPMENT_TYPE2                                       */
/*==============================================================*/
create table EQUIPMENT_TYPE2
(
   K_IDTYPEE2           int not null,
   K_IDTYPEE1           int,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEE2)
);

/*==============================================================*/
/* Table: MAINTENANCE                                           */
/*==============================================================*/
create table MAINTENANCE
(
   K_IDMAINTENANCE      int not null AUTO_INCREMENT,
   K_IDPVD              int,
   K_IDMAINTENANCET     int,
   D_STARTDATE          date not null,
   primary key (K_IDMAINTENANCE)
);

/*==============================================================*/
/* Table: MAINTENANCE_TYPE                                      */
/*==============================================================*/
create table MAINTENANCE_TYPE
(
   K_IDMAINTENANCET     int not null,
   K_NAME               varchar(150) not null,
   primary key (K_IDMAINTENANCET)
);

/*==============================================================*/
/* Table: MC_STATUS                                             */
/*==============================================================*/
create table MC_STATUS
(
   K_IDSTATUSMC         int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDSTATUSMC)
);

/*==============================================================*/
/* Table: PERMISSION                                            */
/*==============================================================*/
create table PERMISSION
(
   K_IDPERMISSION       int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDPERMISSION)
);

/*==============================================================*/
/* Table: PVD                                                   */
/*==============================================================*/
create table PVD
(
   K_IDPVD              int not null,
   K_IDCITY             int,
   K_IDEJECUTOR         int,
   K_IDADMIN            int,
   N_NAME               varchar(200) not null,
   N_DIRECCION          varchar(200) not null,
   N_TIPOLOGIA          varchar(2) not null,
   N_FASE               varchar(2) not null,
   primary key (K_IDPVD)
);

/*==============================================================*/
/* Table: PVD_PLACE                                             */
/*==============================================================*/
create table PVD_PLACE
(
   K_IDPVD_PLACE        int not null,
   K_IDPVDZONE          int,
   K_IDPVDT             varchar(2) not null,
   primary key (K_IDPVD_PLACE),
   key AK_IDENTIFIER_1 (K_IDPVDZONE)
);

/*==============================================================*/
/* Table: PVD_ZONE                                              */
/*==============================================================*/
create table PVD_ZONE
(
   K_IDPVDZONE          int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDPVDZONE)
);

/*==============================================================*/
/* Table: REGION                                                */
/*==============================================================*/
create table REGION
(
   K_IDREGION           int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDREGION)
);

/*==============================================================*/
/* Table: TICKET                                                */
/*==============================================================*/
create table TICKET
(
   K_IDTICKET           varchar(14) not null,
   K_IDMAINTENANCE      int,
   K_IDSTATUSTICKET     int,
   D_STARTDATE          date not null,
   D_FINISHDATE         date,
   I_DURATION           numeric(2,0),
   D_STARTDATEAA        date,
   D_STARTDATEIT        date,
   D_FINISHDATEAA       date,
   D_FINISHDATEIT       date,
   N_COLOR              varchar(20),
   primary key (K_IDTICKET)
);

/*==============================================================*/
/* Table: TICKET_STATUS                                         */
/*==============================================================*/
create table TICKET_STATUS
(
   K_IDSTATUSTICKET     int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDSTATUSTICKET)
);

/*==============================================================*/
/* Table: TICKET_USER                                           */
/*==============================================================*/
create table TICKET_USER
(
   K_IDTICKET           varchar(14) not null,
   K_IDUSER             int not null,
   N_TYPE               varchar(5) not null,
   primary key (K_IDTICKET, K_IDUSER)
);

/*==============================================================*/
/* Table: TYPE_USER                                             */
/*==============================================================*/
create table TYPE_USER
(
   K_IDTYPEUSER         int not null,
   N_DESCRIPTION        varchar(300) not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEUSER)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   K_IDUSER             int not null,
   K_IDTYPEUSER         int,
   N_PASSWORD           varchar(15) not null,
   N_LASTNAME           varchar(80) not null,
   N_NAME               varchar(200) not null,
   N_PROFILEPICTURE     varchar(100),
   primary key (K_IDUSER)
);

/*==============================================================*/
/* Table: USER_PERMISSION                                       */
/*==============================================================*/
create table USER_PERMISSION
(
   K_IDTYPEUSER         int not null,
   K_IDPERMISSION       int not null,
   primary key (K_IDTYPEUSER, K_IDPERMISSION)
);

alter table CITY add constraint FK_DEPARTMENT_CITY foreign key (K_IDDEPARTMENT)
      references DEPARTMENT (K_IDDEPARTMENT) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_DAMAGE_MC foreign key (K_IDDAMAGE)
      references DAMAGE (K_IDDAMAGE) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_EQUIPMENT_MC foreign key (K_IDEQUIPMENT)
      references EQUIPMENT (K_IDEQUIPMENT) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_PVDZ_MC foreign key (K_IDPVDZONE)
      references PVD_ZONE (K_IDPVDZONE) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_PVD_MC foreign key (K_IDPVD)
      references PVD (K_IDPVD) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_STATUS_MC foreign key (K_IDSTATUSMC)
      references MC_STATUS (K_IDSTATUSMC) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_TICKET_MC foreign key (K_IDTICKET)
      references TICKET (K_IDTICKET) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_USER_MC foreign key (K_IDUSER)
      references USER (K_IDUSER) on delete restrict on update restrict;

alter table DEPARTMENT add constraint FK_REGION_DEPARTMENT foreign key (K_IDREGION)
      references REGION (K_IDREGION) on delete restrict on update restrict;

alter table EQUIPMENT add constraint FK_CATEGORY_EQUIPMENT foreign key (K_IDCATEGORYE)
      references EQUIPMENT_CATEGORY (K_IDCATEGORYE) on delete restrict on update restrict;

alter table EQUIPMENT add constraint FK_ET2_EQUIPMENT foreign key (K_IDTYPEE2)
      references EQUIPMENT_TYPE2 (K_IDTYPEE2) on delete restrict on update restrict;

alter table EQUIPMENT_TYPE1 add constraint FK_CETEGORY_TYPEE foreign key (K_IDCATEGORYE)
      references EQUIPMENT_CATEGORY (K_IDCATEGORYE) on delete restrict on update restrict;

alter table EQUIPMENT_TYPE2 add constraint FK_ET1_ET2 foreign key (K_IDTYPEE1)
      references EQUIPMENT_TYPE1 (K_IDTYPEE1) on delete restrict on update restrict;

alter table MAINTENANCE add constraint FK_PVD_MAINTENANCE foreign key (K_IDPVD)
      references PVD (K_IDPVD) on delete restrict on update restrict;

alter table MAINTENANCE add constraint FK_TYPE_MAINTENANCE foreign key (K_IDMAINTENANCET)
      references MAINTENANCE_TYPE (K_IDMAINTENANCET) on delete restrict on update restrict;

alter table PVD add constraint FK_CITY_PVD foreign key (K_IDCITY)
      references CITY (K_IDCITY) on delete restrict on update restrict;

alter table PVD add constraint FK_EJECUTOR_PVD foreign key (K_IDEJECUTOR)
      references EJECUTOR (K_IDEJECUTOR) on delete restrict on update restrict;

alter table PVD add constraint FK_PVD_ADMIN_ foreign key (K_IDADMIN)
      references ADMIN_PVD (K_IDADMIN) on delete restrict on update restrict;

alter table PVD_PLACE add constraint FK_PLACE_ZONE foreign key (K_IDPVDZONE)
      references PVD_ZONE (K_IDPVDZONE) on delete restrict on update restrict;

alter table TICKET add constraint FK_MAINTENANCE_TICKET foreign key (K_IDMAINTENANCE)
      references MAINTENANCE (K_IDMAINTENANCE) on delete restrict on update restrict;

alter table TICKET add constraint FK_TICKET_STATUS foreign key (K_IDSTATUSTICKET)
      references TICKET_STATUS (K_IDSTATUSTICKET) on delete restrict on update restrict;


alter table TICKET_USER add constraint FK_TICKET_USER foreign key (K_IDTICKET)
      references TICKET (K_IDTICKET) on delete restrict on update restrict;

alter table TICKET_USER add constraint FK_TICKET_USER2 foreign key (K_IDUSER)
      references USER (K_IDUSER) on delete restrict on update restrict;

alter table USER add constraint FK_USER_TYPE foreign key (K_IDTYPEUSER)
      references TYPE_USER (K_IDTYPEUSER) on delete restrict on update restrict;

alter table USER_PERMISSION add constraint FK_USER_PERMISSION foreign key (K_IDTYPEUSER)
      references TYPE_USER (K_IDTYPEUSER) on delete restrict on update restrict;

alter table USER_PERMISSION add constraint FK_USER_PERMISSION2 foreign key (K_IDPERMISSION)
      references PERMISSION (K_IDPERMISSION) on delete restrict on update restrict;

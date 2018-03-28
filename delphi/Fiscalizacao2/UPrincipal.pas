unit UPrincipal;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ToolWin, ComCtrls, ImgList, StdCtrls, Grids, Wwdbigrd, Wwdbgrid,
  Menus, Mask, wwdbedit, DBGrids;

type
  TfrmPrincipal = class(TForm)
    ToolBar1: TToolBar;
    ImageList1: TImageList;
    ToolButton1: TToolButton;
    stLotacao: TStaticText;
    ToolButton2: TToolButton;
    GroupBox1: TGroupBox;
    wwDBGrid1: TwwDBGrid;
    StatusBar1: TStatusBar;
    pmHistoricoInfrator: TPopupMenu;
    VisualizarHistoricoInfrator1: TMenuItem;
    VisualizarSolicitao1: TMenuItem;
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure FormShow(Sender: TObject);
    procedure ToolButton1Click(Sender: TObject);
    procedure FormCreate(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
    procedure MostraHint(Sender:TObject);
  end;

var
  frmPrincipal: TfrmPrincipal;

implementation

uses Ulogin, UdmFiscalizacao, DB,
  ADODB;

{$R *.dfm}

procedure TFrmPrincipal.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText:= GetLongHint(Application.Hint);
end;

procedure TfrmPrincipal.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
//  frmSolicitacao := nil;
  frmPrincipal := nil;
  frmLogin.close;
end;

procedure TfrmPrincipal.FormShow(Sender: TObject);
begin
  With dmFiscalizacao.qry do
  begin
    close;
    Sql.text:= 'Select nome from fis_lotacao where codlotacao = ' + quotedstr(dmFiscalizacao.qryLogincodlotacao.AsString) ;
    Open;
  end;
  stLotacao.Caption:= dmFiscalizacao.qry.fieldbyname('nome').AsString + '  ';
  with dmFiscalizacao.qryDenuncia do
    begin
      Close;
      SQL.Text := 'Declare Global Temporary table session.cidadaoReq as ' +
        'select c1.cod_cidadao as codRequerente ' +
        ',      c1.nome_cidadao as requerente ' +
        ',      cd1.numero_documento as CPF ' +
        ',      cd2.numero_documento as CNPJ ' +
        ',      s.idsolicitacao ' +
        'from ger_cidadao c1 left join ger_cidadao_documento cd1 on ' +
        '       c1.cod_cidadao = cd1.cod_cidadao ' +
        '       and cd1.cod_tipo_documento = 2 left join ger_cidadao_documento cd2 on ' +
        '       c1.cod_cidadao = cd2.cod_cidadao ' +
        '       and cd2.cod_tipo_documento = 3,  ' +
        '     fis_solicitacao s  ' +
        'where ' +
        'c1.cod_cidadao in (select distinct idrequerente from fis_solicitacao where idrequerente <> '''') ' +
        'on commit preserve rows with norecovery ';
      ExecSQL;
      Close;
      SQL.Text := 'Declare Global Temporary table session.cidadaoInf as ' +
        'select c1.cod_cidadao as codInfrator ' +
        ',      c1.nome_cidadao as infrator ' +
        ',      cd1.numero_documento as CPF ' +
        ',      cd2.numero_documento as CNPJ ' +
        ',      d.iddenuncia ' +
        'from ger_cidadao c1 left join ger_cidadao_documento cd1 on ' +
        '       c1.cod_cidadao = cd1.cod_cidadao ' +
        '       and cd1.cod_tipo_documento = 2 left join ger_cidadao_documento cd2 on ' +
        '       c1.cod_cidadao = cd2.cod_cidadao ' +
        '       and cd2.cod_tipo_documento = 3,  ' +
        '     fis_denuncia d  ' +
        'where ' +
        'c1.cod_cidadao in (select distinct idinfrator from fis_denuncia where idinfrator <> '''') ' +
        'on commit preserve rows with norecovery ';
      ExecSQL;
    end;
  With dmFiscalizacao.qryDenuncia do
    begin
      Close;
      Sql.Text:= 'select  d.datahoraDenuncia ' +
        ',          d.assunto ' +
        ',          cr.requerente ' +
        ',          ci.infrator ' +
        ',          d.idInfrator ' +
        ',          si.descricao ' +
        ',          d.iddenuncia ' +
        ',          d.idsolicitacao ' +
        'from       fis_denuncia d ' +
        ',          session.cidadaoInf ci ' +
        ',          fis_solicitacao s ' +
        ',          session.cidadaoReq cr ' +
        ',          fis_situacao si ' +
        'where d.idSolicitacao = s.idSolicitacao ' +
        'and   si.idSituacao = d.idSituacao ' +
        'and   ci.iddenuncia = d.iddenuncia ' +
        'and   cr.idsolicitacao = s.idsolicitacao ' +
        'and   cr.codRequerente = s.idrequerente ' +
        'and   ci.codInfrator = d.idinfrator ' +
        'and   si.idsituacao = 1 ' +
        'and   d.codlotacao like ' + QuotedStr(frmLogin.getLotacao + '%');
      Open;
    end;
  Screen.Cursor:= crDefault
end;

procedure TfrmPrincipal.ToolButton1Click(Sender: TObject);
begin
  Screen.Cursor := crHourGlass;
  WinExec('c:\delphi\ingres\fiscalizacao2\cadastro\CadastroFiscalizacao.exe', SW_NORMAL);
  Screen.Cursor := crDefault;
end;

procedure TfrmPrincipal.FormCreate(Sender: TObject);
begin
  Application.OnHint:=MostraHint;
end;

end.

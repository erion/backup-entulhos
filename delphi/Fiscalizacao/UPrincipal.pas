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
    procedure VisualizarHistoricoInfrator1Click(Sender: TObject);
    procedure VisualizarSolicitao1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
    procedure MostraHint(Sender:TObject);
  end;

var
  frmPrincipal: TfrmPrincipal;

implementation

uses Ulogin, UdmFiscalizacao, USolicitacao, UVisualizaSolicitacao, DB,
  ADODB, UHistoricoInfrator;

{$R *.dfm}

procedure TFrmPrincipal.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText:= GetLongHint(Application.Hint);
end;

procedure TfrmPrincipal.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  frmSolicitacao := nil;
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
        'and   d.codlotacao like ' + quotedstr(dmFiscalizacao.qryLogincodlotacao.AsString + '%');
      Open;
    end;
  Screen.Cursor:= crDefault
end;

procedure TfrmPrincipal.ToolButton1Click(Sender: TObject);
begin
  Screen.Cursor := crHourGlass;
  StatusBar1.SimpleText := 'Aguarde!... Carregando tabela de Solicitação.';
  dmFiscalizacao.tbSolicitacao.Open;
  dmFiscalizacao.qryDenunciaSolicitacao.Open;
  application.CreateForm(TfrmSolicitacao, frmSolicitacao);
  frmSolicitacao.Show;
end;

procedure TfrmPrincipal.FormCreate(Sender: TObject);
begin
  Application.OnHint:=MostraHint;
end;

procedure TfrmPrincipal.VisualizarHistoricoInfrator1Click(Sender: TObject);
begin
  StatusBar1.SimpleText := 'Aguarde!... Executando busca...';
  Screen.Cursor := crHourGlass;
  with dmFiscalizacao.qryHistoricoInfrator do
    begin
      Close;
      SQL.Text := 'Declare Global Temporary table session.cidadaoreq as ' +
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
      SQL.Text := 'Declare Global Temporary table session.cidadaoinf as ' +
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
      close;
      SQL.Text := 'select d.iddenuncia, ci.codinfrator, ci.infrator, ci.cpf, ci.cnpj ' +
        ', d.datahoradenuncia, d.datahoraatendimento, d.assunto ' +
        ', d.descricao, d.procedimentos, s.descricao as situacao ' +
        ', cr.requerente, tr.descricao as tiporequerente ' +
        'from fis_denuncia d ' +
        ', fis_situacao s, fis_solicitacao si, fis_tiporequerente tr ' +
        ', session.cidadaoInf ci, session.cidadaoReq cr ' +
        'where s.idSituacao = d.idSituacao ' +
        'and si.idsolicitacao = d.idsolicitacao ' +
        'and tr.idtiporequerente = si.idtiporequerente ' +
        'and ci.codinfrator = d.idinfrator ' +
        'and cr.idsolicitacao = si.idsolicitacao ' +
        'and ci.iddenuncia = d.iddenuncia ' +
        'and cr.codrequerente = si.idrequerente ' +
        'and ci.codInfrator = ' + Trim(dmFiscalizacao.qryDenunciaidinfrator.Value) +
        'order by iddenuncia ';
      codInf := StrToInt(Trim(dmFiscalizacao.qryDenunciaidinfrator.Value));
      Open;
    end;
  with dmFiscalizacao.qryHistoricoInfrator2 do
    begin
      Close;
      SQL.Text := 'select n.codnotificacao ' +
        ',      n.datahoranotificacao, o.descricao as ocorrenciaNotificacao ' +
        ',      a.codautoinfracao, a.datahorainfracao ' +
        ',      r.codapreensao, r.datahoraapreensao ' +
        'from   fis_notificacao n left join fis_autoinfracao a on ' +
        '         n.codnotificacao = a.codnotificacao left join fis_registroapreensao r on ' +
        '         n.codnotificacao = r.codnotificacao left join fis_ocorrencia o on ' +
        '         n.idocorrencia   = o.idocorrencia ' +
        ',      fis_denuncia d ' +
        'where  n.iddenuncia = ' + QuotedStr(dmFiscalizacao.qryParametrosiddenuncia.AsString) +
        'and    d.idinfrator = ' + QuotedStr(dmFiscalizacao.qryDenunciaidinfrator.AsString) +
        'and    n.iddenuncia = d.iddenuncia ' +
        ' order by n.codnotificacao ';
      Open;
    end;
  StatusBar1.SimpleText := '';
  Screen.Cursor := crDefault;
  Application.CreateForm(TfrmHistoricoInfrator,frmHistoricoInfrator);
  frmHistoricoInfrator.Show;
end;

procedure TfrmPrincipal.VisualizarSolicitao1Click(Sender: TObject);
begin
  StatusBar1.SimpleText := 'Aguarde!... Carregando tabela de Solicitação.';
  Screen.Cursor := crHourGlass;
  with dmFiscalizacao.qryVisualizaSolicitacao do
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
      SQL.Text := ' select S.idsolicitacao, C.requerente, U.nome, TR.descricao as TipoRequerente, ' +
        'O.descricao as Origem, TP.descricao as TipoProtocolo, S.numprotocolo, S.dataProtocolo, ' +
        'S.datahoraSolicitacao, S.assunto, S.observacao ' +
        'From fis_solicitacao S, session.cidadaoReq C, fis_usuario U, fis_tiporequerente TR, fis_tipoprotocolo TP, ' +
        'fis_Origem O ' +
        'where C.codRequerente = S.idrequerente and ' +
        '  U.idusuario = S.idusuario and ' +
        '  TR.idtiporequerente = S.idtiporequerente and ' +
        '  TP.idtipoprotocolo = S.idtipoprotocolo and ' +
        '  O.idorigem = S.idorigem and ' +
        '  S.idsolicitacao = ' + dmFiscalizacao.qryDenunciaidsolicitacao.AsString;
      Open;
    end;
  StatusBar1.SimpleText := '';
  Screen.Cursor := crDefault;
  Application.CreateForm(TfrmVisualizaSolicitacao,frmVisualizaSolicitacao);
  frmVisualizaSolicitacao.Show;
end;

end.
